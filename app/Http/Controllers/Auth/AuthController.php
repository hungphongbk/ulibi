<?php

namespace App\Http\Controllers\Auth;

use App\Events\UlibierRegister;
use App\Models\UlibierProfile;
use App\Ulibier;
use App\UlibierSocialite;
use DateTime;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;


class AuthController extends Controller
{
    protected $redirectPath = '/';
    use AuthenticatesAndRegistersUsers, ThrottlesLogins {
        postLogin as postLoginTraditional;
    }
    use UlibierSocialite;

    /**
     * AuthController constructor.
     * @param Socialite $socialite
     */
    public function __construct(Socialite $socialite)
    {
        $this->middleware('guest',['except' => ['getLogout']]);
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        abort(404);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $loginViaSocial=$request->input('via');
        if($loginViaSocial!=null){
            $dbUser=Ulibier::whereEmail($request->input('email'))->first();
            Auth::login($dbUser);
            return $this->handleUserWasAuthenticated($request, null);
        }
        return $this->postLoginTraditional($request);
    }

    /**
     * Show the application registration form.
     * @return Response
     * @internal param string $encodedData
     */
    public function getRegister()
    {
        // if encodedData parameter is not null, parse it into existing user data
        return view('pages.auth.register');
    }

    /**
     * Show the E-mail confirmation page after
     *
     * @return Response
     */
    public function getConfirm()
    {
        return view('pages.auth.mailconfirm');
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getActivated(Request $request){
        $userToken=unserialize(base64_decode($request->query('token')));

        // create new Ulibier
        $user=new Ulibier();
        $user->permission_id=2;
        $user->firstname=$userToken['firstname'];
        $user->lastname=$userToken['lastname'];
        $user->username=substr(hash('md5',$userToken['email']),12);
        $user->email=$userToken['email'];
        $user->password=Hash::make($userToken['password']);
        $user->save();

        // create new Ulibier profile and attach it to above
        /** @var UlibierProfile $profile */
        $profile=$user->profile()->create(array());

        // return to "activated message" page
        return view('pages.auth.signupActivated')->with('user',$user);

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        $rs = $validator->fails();
        if ($rs) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $userData=$request->only(['firstname','lastname','email','password']);
        Event::fire(new UlibierRegister($userData));
        return response()->redirectTo('/ulibier/confirm');
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:Ulibier,email',
            'password' => 'required'
        ]);
    }

    // TODO: Tìm cách redirect tới trang hiện tại (không phải trang chủ) sau khi Login
    /**
     * Redirect to Facebook/Google OAuth login authentication
     * @param string $provider
     * @return Response
     */
    public function socialAuth($provider){
        if(!config("services.$provider"))
            abort('404'); //just to handle providers that doesn't exist
        $p=Socialite::with($provider)
            ->with(array("rdr"=>url()))
            ->asPopup();
        return $p->redirect();
    }

    /**
     * Redirect to Facebook/Google OAuth login authentication
     * Kiểm tra xem Email gắn liền với tài khoản mạng xã hội đã được đăng ký
     *  trong CSDL của Ulibi hay chưa
     * Nếu chưa, redirect tới trang đăng ký Ulibier (yêu cầu sử dụng username, điền sắn
     *  một số field đã có sẵn như email, avatar, ...)
     * Nếu đã có, redirect tới postLogin luôn
     * @param string $provider
     * @return Response
     */
    public function socialAuthCallback($provider){
        /** @var \Laravel\Socialite\AbstractUser $p */
        $p=Socialite::with($provider);
        switch($provider){
            case 'facebook':
                $p->fields($this->facebookRequiredScopes());
                break;
        }
        if($user = Socialite::with($provider)->user()){
            /** @var \App\Ulibier $dbUser */
            $dbUser=Ulibier::whereEmail($user->email)->first();
            if($dbUser===null) {
                $dbUser=Ulibier::create([
                    'permission_id' => 1,
                    'username'      => $user->id,
                    'firstname'     => $this->getSocialField($provider,$user,'firstName'),
                    'lastname'      => $this->getSocialField($provider,$user,'lastName'),
                    'sex'           => $this->getSocialField($provider,$user,'gender'),
                    'birthday'      => new DateTime($this->getSocialField($provider,$user,'birthday')),
                    'email'         => $this->getSocialField($provider,$user,'email'),
                    'phonenumber'   => '+841667578431',
                    'password'      => Hash::make('123456'),
                    'registered_with_social_account'    => true,
                ]);
                $dbUser->avatar_url=$this->getSocialField($provider,$user,'avatar');
            }
            return \View::make('pages.auth.redirect',['form' => [
                'method'=>'POST',
                'action'=>'/ulibier/login',
                'fields'=>[
                    'email'=>$dbUser->email,
                    'via'=>$provider
                ]
            ]]);
        }else{
            return 'something went wrong';
        }
    }

    public function authenticated(Request $request,Ulibier $user) {
        $redirectPath = $request->query('rdr',env('APP_URLROOT'));

        return redirect()->intended($redirectPath);
    }

}
