<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Routing\UrlGenerator;

class Article extends Model
{
    protected $table='Article';
    protected $primaryKey = 'article_id';
    public $timestamps = false;

    protected $hidden = ['user_id','article_id','article_content'];

    /**
     * Get the user that wrote this article
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ulibier() {
        return $this->belongsTo('App\Ulibier');
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
        $destination = $this->destinations()->first()->destination;
        $destination->append('avatar');
        return $destination;
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
}
