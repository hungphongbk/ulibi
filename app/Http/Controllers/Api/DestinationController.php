<?php

namespace App\Http\Controllers\Api;

use App\Models\Destination;
use App\Models\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DestinationController extends ApiController
{
    protected $tableName = 'Destination';

    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request){
        $top=$request->input('top',4);
        $withAvatar=(bool)$request->input('withAvatar',FALSE);

        $data=Destination::all()->take($top);
        if($withAvatar==TRUE){
            foreach ($data as &$dest) {
                $dest['avatar']=$dest->avatar;
            }

        }
        return $data;
    }
}
