<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 11/17/15
 * Time: 1:19 AM
 */

namespace App\Models\Helper;
use App\Models\Comment;


/**
 * Class CommentList
 * @package App\Models
 * @property-read \App\Models\ContentBase $content
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 */
trait CommentList
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public abstract function content();

    /**
     * @return Comment[]
     */
    public function getCommentsAttribute()
    {
        /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $rs */
        /** @var \App\Models\Comment|null $item */
        $rs = $this->content->comments;

        if (count($rs) == 0)
            return $rs;

        $i = 0;
        $item = null;
        do {
            global $item;
            $item = $rs[$i];
            $rs = $rs->merge($item->content->comments);
            $i++;
        } while ($i < count($rs));

        return $rs;
    }
}
