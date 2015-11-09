<?php

namespace App\Http\Controllers\Views;

use App\Models\ContentBase;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class PhotoController extends Controller
{
    use PaginateContent, \App\Http\Controllers\ConsoleHelper;
    protected $perPage=12;
    protected $paginatorPath='photo';
    protected $command;
    /**
     * PhotoController constructor.
     */
    public function __construct()
    {
        // Only ulibiers have authority to post & delete photo
        $this->middleware('auth',['except'=>'index']);
        // Prevent hacker use CSRF attack to post & delete automatically
        $this->middleware('csrf',['only'=>[ 'store', 'destroy' ]]);
        // Generate command for console something
        $this->command=new \Symfony\Component\Console\Output\ConsoleOutput();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginates=$this->createPaginator(Photo::all());
        return View::make('pages.photos', [
            'photos'        => $paginates
        ]);
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
        if($request->ajax()){
            //$this->consolePrintInfo(substr($request->input('internal_url'),0,50));
            $newPhoto=new Photo();
            $newPhoto->des_id=null;
            $newPhoto->internal_url=$request->input('internal_url');

            $content=new ContentBase();
            $content->content_type=1;
            $content->save();
            $content->photo()->save($newPhoto);

            return response()->json(array(
                'status' => 'succeeded',
                'id' => $newPhoto->photo_id
            ));
        } else {
            return response('OK', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$photo)
    {
        //
        if($request->ajax()){
            $uploader = $photo->owner->full_name;
            $rs= $photo->toArray();
            $rs['uploader'] = $uploader;
            return json_encode($rs);
        }
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
