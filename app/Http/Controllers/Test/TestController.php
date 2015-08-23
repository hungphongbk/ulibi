<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 8/22/15
 * Time: 7:01 PM
 */

namespace App\Http\Controllers\Test;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    /**
     * @return Response
     */
    public function getIndex(){
        return view('test/index');
    }
}