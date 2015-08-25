<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='Comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;
}
