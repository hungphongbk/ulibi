<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/20/15
 * Time: 2:05 PM
 */

namespace App\Helpers\Contracts;


use App\Models\Article;
use App\Models\ContentBase;
use App\Models\Destination;
use App\Models\Mapping\ArticleDestination;
use App\Models\Mapping\ArticleTag;
use App\Models\Photo;
use App\Models\Tag;
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
        /** @var \App\Models\ContentBase $newContent */
        $newContent = ContentBase::create(['content_type' => 0]);
        $newArticle = $newContent->article()->create($request->only($this->articleFields));

        if ($request->input('cover_id') != 0) {
            $newArticle['cover_id'] = $request->input('cover_id');
            $newArticle->save();
        }

        // get all checked-in destinations
        /** @var array $dest */
        $dest = array_map(function ($item) {
            $rs = Destination::where('des_name', $item->des_name)->first();
            return $rs;
        }, (array)json_decode($request->input('destinations')));
        foreach ($dest as $d) {
            /** @var Destination $d */
            $m = new ArticleDestination();
            $m->article_id = $newArticle->article_id;
            $m->des_id = $d->des_id;
            $m->save();
        }

        // get all tagged tags
        $tags = array_map(function ($item) {
            return Tag::where('tag_name', $item->tag_name)->first();
        }, (array)json_decode($request->input('tagnames')));
        /** @var Tag $t */
        foreach ($tags as $t) {
            $m = new ArticleTag();
            $m->article_id = $newArticle->article_id;
            $m->tag_id = $t->tag_id;
            $m->save();
        }

        return $newArticle;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validate($request){
        $validatorRules=array(
            'article_title' => 'required',
            'article_content' => 'required'
        );
        $validator=\Validator::make($request->all(),$validatorRules);
        return $validator;
    }
}