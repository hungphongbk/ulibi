<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ResourceController
 * @package App\Http\Controllers\Api
 */
class ResourceController extends Controller
{

    /**
     * @param Request $request
     * @param $type
     * @param $filename
     * @return mixed
     */
    public function getIndex(Request $request,$type,$filename)
    {
        $method='get'.ucfirst($type);
        if(method_exists($this,$method))
            return $this->$method($request,$filename);
        return response()->json([
            "error" => "method not found",
            "target" => "method($method)"
        ]);
    }

    /**
     * Default width for image request is 600px
     * @param Request $request
     * @param $filename
     * @return mixed
     */
    private function getImage(Request $request,$filename){
        /** @var int $maxWidth */
        $maxWidth=$request->query('w',600);
        try{
            $file = Storage::get('/imgtemp/'.$filename);
            $file = Photo::resize_photo($file, $maxWidth);
        }catch (Exception $e){
            return response()->json(array("error"=>$e->getMessage()), 404);
        }
        $response = response()->make($file, 200);
        return $response;
    }
}
