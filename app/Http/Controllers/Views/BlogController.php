<?php

namespace App\Http\Controllers\Views;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use View;

class BlogController extends Controller
{
    use PaginateContent;
    protected $perPage=6;
    protected $paginatorPath='blog';
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function index()
    {
        $articles=Article::all()->each(function($i){
            /** @var Article $i */
            $i->append('first_related_destination');
        });
        $paginates=$this->createPaginator($articles);

        return View::make('pages.blog',['articles'=>$paginates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        $article->append('first_related_destination')
            ->append('content_as_html');
        return View::make('pages.blogdetail',['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
