<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

/**
 * Class ResourceController
 * @package App\Http\Controllers\Api
 */
class ResourceController extends Controller
{

    /**
     * @param $type
     * @param $filename
     * @return mixed
     */
    public function getIndex($type,$filename)
    {
        $method='get'.ucfirst($type);
        if(method_exists($this,$method))
            return $this->$method($filename);
        return response()->json([
            "error" => "method not found",
            "target" => "method($method)"
        ]);
    }

    /**
     * @param $filename
     * @return mixed
     */
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
