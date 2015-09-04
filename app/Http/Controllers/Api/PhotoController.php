<?php

namespace App\Http\Controllers\Api;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class PhotoController extends ApiController
{
    protected $tableName = 'Photo';

    /*
     * Upload a photo to Amazon S3 bucket
     */
    public function postUpload(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $image = $request->file('image');

        $photo_uptime = time();
        $hash=uniqid($photo_uptime,true);
        $imageFilename = $hash.'.'.$image->getClientOriginalExtension();
        Storage::put('/imgtemp/'.$imageFilename,file_get_contents($image), 'public');

        /*$photo = Photo::create(array(
            'user_id'           => $user['user_id'],
            'photo_uptime'      => $photo_uptime,
            'photo_hash'        => $hash,
            'photo_extensions'  => $image->getClientOriginalExtension(),
            'photo_like'        => 0,
            'des_id'            => $request->input('des_id')
        ));*/
        $photo=Photo::create(array('user_id' => $user['user_id']));
        $photo->photo_uptime = $photo_uptime;
        $photo->photo_hash = $hash;
        $photo->photo_extensions = $image->getClientOriginalExtension();
        $photo->des_id = $request->input('des_id');

        return $photo;
    }
}