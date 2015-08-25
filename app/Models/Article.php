<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='Article';
    protected $primaryKey = 'article_id';
    public $timestamps = false;

    protected $hidden = ['user_id'];

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
}
