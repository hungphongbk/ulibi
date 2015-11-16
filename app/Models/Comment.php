<?php

namespace App\Models;

use App\Ulibier;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property integer $comment_id
 * @property string $comment_time
 * @property string $comment_content
 * @property string $username
 * @property integer $article_id
 * @property-read \App\Models\ContentBase $content
 * @property-read \App\Models\ContentBase $parent
 * @property-read int|null $parent_comment
 * @property int content_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereArticleId($value)
 */
class Comment extends Model
{
    protected $table = 'Comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = true;
    protected $appends = ['author_name', 'author_avatar', 'parent_comment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo('App\Models\ContentBase', 'comment_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo('App\Models\ContentBase', 'content_id', 'content_id');
    }

    public function getAuthorNameAttribute()
    {
        $author = Ulibier::find($this->username);
        return $author->full_name;
    }

    public function getAuthorAvatarAttribute()
    {
        $author = Ulibier::find($this->username);
        return $author->thumbnail_400;
    }

    /**
     * @return int|null
     */
    public function getParentCommentAttribute()
    {
        if ($this->parent->is_comment) return $this->content_id;
        return null;
    }
}
