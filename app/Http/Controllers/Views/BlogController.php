<?php

namespace App\Http\Controllers\Views;

use App\Helpers\Contracts\ArticlePost;
use App\Models\Article;
use App\Models\Destination;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            'viewTemplate'=>'blogitem2col',
            'bsColumn' => [
                'left' => 'col-md-9',
                'right' => 'col-md-2 col-md-offset-1'
            ],
            'articles'=>$paginates,
            'createUrl' => url('/blog/create'),
            'manageUrl' => url('/blog/manage')
        ]);
    }

    /**
     * Display a listing of articles which written by yours.
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function manage(){
        $articles=\Auth::user()->articles;
        $paginates=$this->createPaginator($articles);

        return View::make('pages.blog',[
            'viewTemplate'=>'blogitemLeftImg',
            'bsColumn' => [
                'left' => 'col-md-8',
                'right' => 'col-md-3 col-md-offset-1'
            ],
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
        // data for tags and suggestion
        $tags=Tag::all();
        $dest=Destination::all(['des_id','des_name','coordinate']);

        return View::make('pages.blogpost',[
            'model'     => new Article(),
            'action'    => 'blog.store',
            'method'    => 'POST',
            'tags'      => $tags->toJson(),
            'dest'      => $dest->toJson()
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
        $validate=$this->articlePost->validate($request);
        if($validate->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }
        $newArticle=$this->articlePost->doPost($request);
        $this->consolePrintInfo("New Article Posted: $newArticle->article_title");
        return response()->redirectTo('/blog/'.$newArticle->article_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        // Increase views
        $article->view++;
        $article->save();

        // Output
        $article->append('first_related_destination')
            ->append('content_as_html');
        return View::make('pages.blogdetail',['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {

        $tags=Tag::all();
        $dest=Destination::all(['des_id','des_name','coordinate']);

        return View::make('pages.blogpost',[
            'model'     => $article,
            'action'    => array('blog.update', $article->article_id),
            'method'    => 'PUT',
            'tags'      => $tags->toJson(),
            'dest'      => $dest->toJson()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $article)
    {
        $input = array_except($request->input(), array('_method','_token','tagnames','destinations'));
        $article->update($input);
        return response()->redirectTo('/blog/'.$article->article_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($article)
    {
        $article->delete();
    }
}
