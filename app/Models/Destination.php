<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * @property Collection photos
 * @property string des_name
 * @property mixed des_id
 * @property mixed coordinate
 * @property string des_instruction
 * @property Photo avatar
 */
class Destination extends SpartialModel
{
    protected $table='Destination';
    protected $primaryKey = 'des_id';
    public $timestamps = false;

    protected $fillable = ['des_name'];
    protected $hidden = ['coordinate'];
    protected $appends = ['location', 'avatar'];
    protected $geofields=['location'];

    use Thumbnail;

    /**
     * Get all photos of this destination
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
        return $this->hasMany(Photo::class, 'des_id', 'des_id');
    }

    /**
     * @return Photo|null
     */
    public function getAvatarAttribute(){
        try {
            /** @var \App\Models\Photo $photo */
            $photo = $this->photos->random();
            return $photo;
        } catch (\Exception $e){
            return null;
        }
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute(){
        $photo=$this->avatar;
        if($photo==null)
            return Photo::samplePhotoUrl();
        return $photo->src;
    }

    public function getLocationAttribute(){
        $coors = $this->attributes['coordinate'];
        $rs = unpack('L/c/L/dlongitude/dlatitude',$coors);
        array_shift($rs);
        return $rs;
    }
}
