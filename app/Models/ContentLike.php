<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContentLike
 *
 * @property string $username
 * @property int content_id
 */
class ContentLike extends Model
{
    protected $table = 'ContentLike';
    public $timestamps = false;

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        if ($this->exists) {
            if ($this->fireModelEvent('deleting') === false) {
                return false;
            }

            // Here, we'll touch the owning models, verifying these timestamps get updated
            // for the models. This will allow any caching to get broken on the parents
            // by the timestamp. Then we will go ahead and delete the model instance.
            $this->touchOwners();

            DB::statement("DELETE FROM ContentLike WHERE content_id=$this->content_id AND username='$this->username'");

            $this->exists = false;

            // Once the model has been deleted, we will fire off the deleted event so that
            // the developers may hook into post-delete operations. We will then return
            // a boolean true as the delete is presumably successful on the database.
            $this->fireModelEvent('deleted', false);

            return true;
        }
        return true;
    }
}
