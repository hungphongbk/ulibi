<?php

namespace App\Models\Mapping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class ArticleDestination extends Model
{
    protected $table='ArticleDestinationMapping';
    public $timestamps = false;

    public function destination(){
        return $this->belongsTo('App\Models\Destination','des_id');
    }
}
