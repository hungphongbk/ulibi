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
 * @property int content_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereArticleId($value)
 */
class Comment extends Model
{
    protected $table='Comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;
    protected $appends = ['author_name', 'author_avatar'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(){
        return $this->belongsTo('App\Models\ContentBase', 'photo_id', 'content_id');
    }

    public function getAuthorNameAttribute(){
        $author=Ulibier::find($this->username);
        return $author->full_name;
    }

    public function getAuthorAvatarAttribute(){
        $author=Ulibier::find($this->username);
        return $author->thumbnail_400;
    }
}
