<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $redirectPath = '/admin';
    protected $loginPath = '/admin/login';
    protected $username = 'username';
    use AuthenticatesUsers;
    //
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['getLogin','postLogin']]);
    }

    public function getIndex(){
        return \View::make('admin');
    }

    public function getLogin(){
        return \View::make('adminLogin');
    }
}
