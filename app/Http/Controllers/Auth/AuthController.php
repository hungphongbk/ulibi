<?php

namespace App\Http\Controllers\Auth;

use App\Ulibier;
use Auth;
use App\User;
use Exception;
use HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['postAuthenticate']]);
    }
    public function getIndex()
    {
        return Ulibier::all();
    }

    public function postAuthenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function postSignup(Request $request){
        $credentials = $request->only('username', 'password');

        try {
            $user=Ulibier::create($credentials);
        } catch (Exception $e){
            return response()->json(['error' => 'User already exists.'], 409);
        }

        $token=JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }
}
