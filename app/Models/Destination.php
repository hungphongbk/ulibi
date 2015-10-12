<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed photos
 * @property mixed des_name
 * @property mixed des_id
 */
class Destination extends Model
{
    protected $table='Destination';
    protected $primaryKey = 'des_id';
    public $timestamps = false;

    protected $fillable = ['des_name'];
    protected $hidden = ['coordinate', 'des_id'];
    protected $appends = ['location'];

    /**
     * Get all photos of this destination
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
        return $this->hasMany(Photo::class, 'des_id', 'des_id');
    }

    public function getAvatarAttribute(){
        try {
            $photos = $this->photos()
                ->get(array('photo_awss3_url'))
                ->first();
            return $photos->photo_awss3_url;
        } catch (\ErrorException $e){
            return null;
        }
    }

    public function getLocationAttribute(){
        $coors = $this->attributes['coordinate'];
        $rs = unpack('L/c/L/dlongitude/dlatitude',$coors);
        array_shift($rs);
        return $rs;
    }
}
