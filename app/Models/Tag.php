<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table='Tag';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;
}
