<?php

namespace App\Http\Controllers\Views;

use App\Helpers\Contracts\ArticlePost;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use View;

class BlogController extends Controller
{
    use PaginateContent, \App\Http\Controllers\ConsoleHelper;
    protected $perPage=6;
    protected $paginatorPath='blog';
    protected $command;
    protected $articlePost;

    /**
     * BlogController constructor.
     * @param ArticlePost $articlePost
     */
    public function __construct(ArticlePost $articlePost)
    {
        // Only ulibiers have authority to post & delete article
        $this->middleware('auth',['except'=>['index', 'show']]);
        // Prevent hacker use CSRF attack to post & delete automatically
        $this->middleware('csrf',['only'=>[ 'store', 'destroy' ]]);
        // Generate command for console something
        $this->command=new \Symfony\Component\Console\Output\ConsoleOutput();

        $this->articlePost=$articlePost;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function index()
    {
        $articles=Article::renderAll();
        $paginates=$this->createPaginator($articles);

        return View::make('pages.blog',[
            'articles'=>$paginates,
            'createUrl' => url('/blog/create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('pages.blogpost',[
            'actionUrl' => url('/blog')
        ]);
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
        /** @var Article $newArticle */
        $newArticle=$this->articlePost->doPost($request);
        $this->consolePrintInfo("New Article Posted: $newArticle->article_title");
        return response()->redirectTo('/');
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
