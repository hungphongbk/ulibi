<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/24/15
 * Time: 5:16 PM
 */

namespace App\Helpers;


class MyUrlHelper
{
    public static function socialLoginUrl($provider){
        return url('/ulibier/social/'.$provider.'?rdr='.urlencode(url()));
    }
}