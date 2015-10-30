<?php

namespace App;

use App\Models\Photo;
use App\Models\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * App\Ulibier
 *
 * @property string $username
 * @property integer $permission_id
 * @property string $firstname
 * @property string $lastname
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string $blog_url
 * @property string $report
 * @property boolean $registered_with_social_account
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Models\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|Models\Photo[] $photos
 * @property string $avatar_url
 * @property \App\UlibierPermission permission
 * @property \App\Models\UlibierProfile profile
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier wherePhonenumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereNationality($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereBlogUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereReport($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereAvatar($value)
 * @method static \Illuminate\Support\Collection|\App\Ulibier find($username)
 */
class Ulibier extends Model  implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Thumbnail;

    protected $table = 'Ulibier';
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $guarded = ['report'];
    protected $hidden = ['password', 'created_at', 'updated_at'];
    protected $appends = ['avatar_url','full_name'];

    /**
     * Get this user's permission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission() {
        return $this->belongsTo(UlibierPermission::class, 'permission_id');
    }

    /**
     * Get all articles this user wrote
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles() {
        return $this->hasMany(Models\Article::class ,'username','username');
    }

    public function photos() {
        return $this->hasMany(Models\Photo::class, 'username', 'username');
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->profile->avatar==NULL) return Photo::samplePhotoUrl();
        /** @var Photo|null $avatar */
        $avatar = $this->profile->avatar;
        return $avatar->src;
    }

    public function getThumbnailAttribute() {
        return $this->avatar_url;
    }

    public function getCoverAttribute() {
        if($this->profile->cover==NULL) return Photo::samplePhotoUrl();
        /** @var Photo|null $cover */
        $cover = $this->profile->cover;
        return $cover->src;
    }

    /**
     * @param string $value
     * @throws \ErrorException
     */
    public function setAvatarUrlAttribute($value)
    {
        /** @var Photo $photo */
        $photo=new Photo();
        $photo->internal_url=$value;
        $photo=$this->photos()->save($photo);
        $this->profile->avatar_id = $photo->photo_id;
        $this->profile->save();
    }

    public function getFullNameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(){
        return $this->hasOne(Models\UlibierProfile::class, 'username');
    }
}
