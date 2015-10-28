<?php

namespace App\Models;

use App\Ulibier;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Photo|null avatar
 * @property Photo|null cover
 * @property Ulibier ulibier
 */
class UlibierProfile extends Model
{
    protected $table = 'UlibierProfile';
    protected $primaryKey = 'username';
    public $timestamps = false;
    protected $casts = [
        'birthday' => 'date'
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(Photo::class, 'photo_id', 'avatar_id');
    }

    public function cover()
    {
        return $this->hasOne(Photo::class, 'photo_id', 'cover_id');
    }

    public function ulibier()
    {
        return $this->belongsTo(Ulibier::class, 'username');
    }
}
