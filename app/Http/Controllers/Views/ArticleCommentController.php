<?php

namespace App\Http\Controllers\Views;

use App\Models\Article;
use App\Models\Comment;
use App\Models\ContentBase;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleCommentController extends Controller
{
    /**
     * ArticleCommentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function index($article)
    {
        if (request()->ajax()) {
            return response()->json($article->comments);
        }
        return response('');
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
     * @param  \Illuminate\Http\Request $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $comment = new Comment();
        $comment->comment_content = $request->get('comment_content');
        $comment->username = Auth::user()->username;

        /** @var \App\Models\ContentBase $contentBase */
        $contentBase = ContentBase::create(['content_type' => 2]);
        $comment->comment_id = $contentBase->content_id;
        $parent=$request->get('parent_comment');
        if($parent)
            $comment->content_id = $parent;
        else
            $comment->content_id = $article->content->content_id;
        $comment->save();

        if ($request->ajax())
            return response()->json($comment);
        return response('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
