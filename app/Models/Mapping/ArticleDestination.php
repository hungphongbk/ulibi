<?php

namespace App\Models\Mapping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

/**
 * App\Models\Mapping\ArticleDestination
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $des_id
 * @property-read \App\Models\Destination $destination
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mapping\ArticleDestination whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mapping\ArticleDestination whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mapping\ArticleDestination whereDesId($value)
 */
class ArticleDestination extends Model
{
    protected $table='ArticleDestinationMapping';
    public $timestamps = false;

    public function destination(){
        return $this->belongsTo('App\Models\Destination','des_id');
    }
}
