<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentBase
 * @package App\Models
 * @property-read \App\Models\Article|null $article
 * @property-read \App\Models\Photo|null $photo
 * @property-read \App\Models\Comment|null $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContentLike[] $like
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read boolean $liked
 * @property-read int $like_count
 * @property-read int $comment_count
 * @property int content_type
 * @property int content_id
 */
class ContentBase extends Model
{
    protected $table = 'ContentBase';
    protected $primaryKey = 'content_id';
    public $timestamps = true;
    public $appends = ['liked', 'like_count'];
    protected $fillable = ['content_type'];

    /**
     * Save a new model and return the instance.
     *
     * @param Article $article
     * @return static
     */
    public static function createNewArticle(Article $article)
    {
        /** @var ContentBase $contentObj */
        $contentObj = parent::create(["content_type" => 0]);
        $contentObj->article()->save($article);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article()
    {
        return $this->hasOne('\App\Models\Article', 'article_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photo()
    {
        return $this->hasOne('\App\Models\Photo', 'photo_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function comment()
    {
        return $this->hasOne('\App\Models\Comment', 'comment_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('\App\Models\Comment', 'content_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function like()
    {
        return $this->hasMany('\App\Models\ContentLike', 'content_id', 'content_id');
    }

    /**
     * @return int
     */
    public function getLikeCountAttribute()
    {
        return $this->like->count();
    }

    /**
     * @return int
     */
    public function getCommentCountAttribute()
    {
        return $this->comments->count();
    }

    /**
     * @return bool
     */
    public function getLikedAttribute()
    {
        if (!\Auth::user()) return false;
        if ($this->like->count() == 0) return false;
        $rs = $this->like->where('username', \Auth::user()->username)->first();
        return $rs != null;
    }
}
