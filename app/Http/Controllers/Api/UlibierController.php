<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ulibier;

class UlibierController extends ApiController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request){
        return array('warning' => 'Api not exists' );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getTrending(Request $request){
        $top=$request->input('top',3);
        $context=$request->input('context','article');

        $data=Ulibier::all()->take($top);
        if($context==='article')
            return $this->getTrendingWithArticle($data);
    }

    /**
     * @param array $data
     * @return Response
     */
    private function getTrendingWithArticle($data){
        foreach ($data as $user) {
            $article=$user->articles()->first();
            if(!$article) continue;
            $article->enterMode('trending-destination-photo');
            $user['trending_article']=$article;
        }
        return $data;
    }
}
