<?php

namespace App\Models\Mapping;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int article_id
 * @property int tag_id
 */
class ArticleTag extends Model
{
    protected $table='ArticleTag';
    public $timestamps = false;
}
