<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/20/15
 * Time: 2:02 PM
 */

namespace App\Helpers\Contracts;

use Illuminate\Http\Request;

/*
 * We have some sequenced jobs:
 * Create new photo which corresponding to the cover photo of article
 */
interface IArticlePost
{
    /**
     * @param Request $request
     * @return \App\Models\Article
     */
    public function doPost(Request $request);
}