<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentBase
 * @package App\Models
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\Photo $photo
 */
class ContentBase extends Model
{
    protected $table='ContentBase';
    protected $primaryKey = 'content_id';
    public $timestamps = true;

    /**
     * Save a new model and return the instance.
     *
     * @param Article $article
     * @return static
     */
    public static function createNewArticle(Article $article)
    {
        /** @var ContentBase $contentObj */
        $contentObj = parent::create([ "content_type" => 0 ]);
        $contentObj->article()->save($article);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article(){
        return $this->hasOne('\App\Models\Article', 'article_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photo(){
        return $this->hasOne('\App\Models\Photo', 'photo_id', 'content_id');
    }
}
