<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int tag_id
 * @property string tag_name
 */
class Tag extends Model
{
    protected $table='Tag';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;
}
