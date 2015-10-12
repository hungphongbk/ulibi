<?php

namespace App\Http\Controllers\Auth;

use App\Ulibier;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $redirectPath = '/';
    protected $username = 'username';
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest',['except' => ['getLogout']]);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        abort(404);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('pages.auth.register');
    }

    /**
     * Show the E-mail confirmation page after
     *
     * @return \Illuminate\Http\Response
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
        $user=Ulibier::findOrNew($request->input('ulibier'));
        return view('pages.auth.signupActivated')->with('user',$user);

    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => $this->getFailedLoginMessage(),
            ]);
    }*/

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $this->create($request->all());
        return response()->redirectTo('/ulibier/confirm');
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:Ulibier,email'
        ]);
    }

    protected function create(array $data)
    {
        return Ulibier::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
