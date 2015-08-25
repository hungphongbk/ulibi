<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
