<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    protected $tableName;
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['getAll','getTrending']]);
    }

    /**
     * Display all
     * @return Response
     */
    public function getAll(Request $request){
        return call_user_func(array('App\\Models\\'.$this->tableName, 'all'));
    }
}
