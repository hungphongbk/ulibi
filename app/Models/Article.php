<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Article
 *
 * @property integer $article_id
 * @property integer $user_id
 * @property integer $article_like
 * @property string $article_title
 * @property string $article_content
 * @property string $article_date
 * @property integer $view
 * @property int cover_id
 * @property-read \App\Ulibier $ulibier
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property-read mixed $first_related_destination
 * @property-read mixed $render_html
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereView($value)
 */
class Article extends ContentModel
{
    protected $table='Article';
    protected $primaryKey = 'article_id';
    public $timestamps = false;
    protected $hidden = ['user_id','article_id','article_content'];
    protected $guarded=[];
    protected $casts = [
        'article_date' => 'date'
    ];

    protected $contentField = 'article_content';
    protected $contentFieldType = 'article_content_type';

    /**
     * Get the user that wrote this article
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ulibier() {
        return $this->belongsTo('App\Ulibier','user_id');
    }

    /**
     * Get all comments of this article
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }

    /**
     * Get all destinations related to this article
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function destinations() {
        $list = $this->hasMany(Mapping\ArticleDestination::class, 'article_id', 'article_id');
        return $list->getResults();
    }

    /**
     * Get all destinations related to this article
     * @return \App\Models\Destination
     */
    public function getFirstRelatedDestinationAttribute() {
        try {
            /** @var \App\Models\Destination $destination */
            $destination = $this->destinations()->first()->destination;
            $destination->append('avatar');
            return $destination;
        } catch (\ErrorException $e){
            return null;
        }
    }

    public function getThumbnailAttribute(){
        if($this->cover_id!=null){
            return Photo::findOrFail($this->cover_id)->src;
        } else return $this->first_related_destination->avatar;
    }

    public function getViewUrlAttribute() {
        return url('/blog/'.$this->article_id);
    }

    public function enterMode($mode){
        switch($mode){
            case 'trending-destination-photo':
                $this->append('first_related_destination');
                break;
            case 'render-content-to-html':
                $this->append('render_html');
                break;
            default:
                break;
        }
    }

    public function getRenderHtmlAttribute(){
        return '/api/article/toHtml?id='.$this->article_id;
    }

    /**
     * @param int $number
     * @return Collection
     */
    public static function renderAll($number=0){
        /** @var Collection $all */
        $all=Article::all();
        if($number>0)
            $all=$all->random($number);
        foreach ($all as $i){
            /** @var Article $i */
            $i->append([
                'first_related_destination',
                'thumbnail',
                'view_url'
            ]);
        }
        return $all;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(
        /**
         * @param $article
         */
            function($article){
            if($article['user_id']==null){
                $article['user_id']=Auth::user()->user_id;
            }
        });
    }
}
