<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //
            return Destination::all()->each(function ($i) {
                /** @var \App\Models\Destination $i */
                $i->append(['avatar']);
            });
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage()]);
        }
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
        try {
            $inputs = array('des_name', 'des_coors', 'des_instruction', 'related_photos');
            $obj = array('message' => 'succeeded');
            foreach ($inputs as $field)
                $obj[$field] = $request->input($field, '');

            // TODO: cuối cùng vẫn phải chạy Raw SQL -_-
            $destination=DB::table('Destination')->insertGetId(array(
                'des_name' => $obj['des_name'],
                'des_instruction' => $obj['des_instruction'],
                'coordinate' => DB::raw("GeomFromText(\"POINT(".$obj['des_coors']['latitude']." ".$obj['des_coors']['longitude'].")\")")
            ));
            // upload selected images too
            $images_uploaded=array();
            $relPhotos=$obj['related_photos'];
            if($relPhotos)
            foreach ($relPhotos as $photo)
            if ($photo['selected'])
            {
                $rq=Request::create("/admin/destination/$destination/photo","POST",[],[],[],[],array('photo_url'=>$photo['url'], 'photo_like' => rand(0,100)));
                array_push($images_uploaded,Route::dispatch($rq)->getContent());
            }

            return response()->json(array(
                'addedObject'=>Destination::find($destination),
                'addedPhotos'=>$images_uploaded
            ));
        } catch (\Exception $e){
            return response()->json($e);
        }
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
