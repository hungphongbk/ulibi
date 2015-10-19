<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use mnshankar\CSV\CSV;

// TODO: handle when user send https image exception!!!
class DestinationPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Destination $dest
     * @return \Illuminate\Http\Response
     */
    public function index(Destination $dest)
    {
        //
        return $dest->photos;
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
     * @param Destination $dest
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Destination $dest,Request $request)
    {
        $photo_url=$request->input('photo_url');
        $photo_like=$request->input('photo_like',0);

        $photo_csvFile=database_path('seeds/csv/Photo.csv');
        $csv=new CSV();
        $photo_csvContent=$csv->fromFile($photo_csvFile)->toArray();
        $photo_added=array([
            'user_id' => \Auth::user()->user_id,
            'des_id' => $dest->des_id,
            'photo_like' => $photo_like,
            'photo_sample_name' => $photo_url
        ]);
        array_push($photo_csvContent,$photo_added);
        $csv->with($photo_csvContent)->put($photo_csvFile);

        // insert image to database
        $uploadtime = time();
        $img_ext=pathinfo($photo_url,PATHINFO_EXTENSION)||'jpg';
        $hash=uniqid($uploadtime,true);
        $local_imgname=$hash.'.'.$img_ext;
        Storage::put('/imgtemp/'.$local_imgname,file_get_contents($photo_url));

        /** @var Photo $photo */
        $photo=Photo::create(array(
            'user_id'       => \Auth::user()->user_id,
            'des_id'        => $dest->des_id,
            'photo_like'    => $photo_like,
            'photo_hash'    => $hash,
            'photo_uptime'  => $uploadtime,
            'photo_extensions'  => $img_ext
        ));

        return response()->json($photo,200);
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
