<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{

    public function getIndex($type,$filename)
    {
        return $this->getImage($filename);
    }

    private function getImage($filename){
        $local=Storage::disk('local');
        try{
            $file = $local->get('/imgtemp/'.$filename);
        }catch (Exception $e){
            return response()->json("{}", 404);
        }
        $response = response()->make($file, 200);
        return $response;
    }
}
