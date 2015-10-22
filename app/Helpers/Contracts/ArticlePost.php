<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/20/15
 * Time: 2:05 PM
 */

namespace App\Helpers\Contracts;


use App\Models\Article;
use App\Models\Photo;
use Illuminate\Http\Request;

class ArticlePost implements IArticlePost
{
    protected $articleFields=['article_title','article_content','article_content_type','article_date'];

    /**
     * @param Request $request
     * @return Article
     */
    public function doPost(Request $request)
    {
        // TODO: Implement doPost() method.
        $newArticle=Article::create($request->only($this->articleFields));
        return $newArticle;
    }
}