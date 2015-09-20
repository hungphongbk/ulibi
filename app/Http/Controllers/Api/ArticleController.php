<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleController extends ApiController
{
    protected $tableName = 'Article';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user->articles;
    }

    /**
     * Display all
     * @return Response
     */
    public function getAll(Request $request){
        $withHtmlRenderLink=(bool)$request->input('renderContent',FALSE);
        $data=parent::getAll($request);

        if(!$withHtmlRenderLink)
            return $data;

        foreach ($data as $item) {
            $item->enterMode('render-content-to-html');
        }
        return $data;
    }

    public function getToHtml(Request $request){
        $id=$request->input('id');
        return response()->json(['id'=>$id]);
    }
}
