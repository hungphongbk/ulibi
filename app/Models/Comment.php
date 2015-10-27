<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property integer $comment_id
 * @property string $comment_time
 * @property string $comment_content
 * @property string $username
 * @property integer $article_id
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
}
