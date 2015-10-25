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
 * @property integer $user_id
 * @property integer $permission_id
 * @property string $firstname
 * @property string $lastname
 * @property string $full_name
 * @property string $sex
 * @property string $birthday
 * @property string $email
 * @property string $phonenumber
 * @property string $nationality
 * @property string $username
 * @property string $password
 * @property string $blog_url
 * @property string $report
 * @property boolean $registered_with_social_account
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|Models\Article[] $articles
 * @property string $avatar_url
 * @property \App\UlibierPermission permission
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier wherePhonenumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereNationality($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereBlogUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereReport($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ulibier whereAvatar($value)
 */
class Ulibier extends Model  implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Thumbnail;

    protected $table = 'Ulibier';
    protected $primaryKey = 'user_id';
    protected $guarded = ['report','avatar'];
    protected $hidden = ['user_id', 'password', 'created_at', 'updated_at', 'avatar'];
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
        return $this->hasMany(Models\Article::class ,'user_id','user_id');
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar==NULL) return Photo::samplePhotoUrl();
        /** @var Photo|null $avatar */
        $avatar = Models\Photo::find($this->avatar);
        return $avatar->src;
    }

    public function getThumbnailAttribute() {
        return $this->avatar_url;
    }

    /**
     * @param string $value
     */
    public function setAvatarUrlAttribute($value)
    {
        $photo=Photo::create([
            'user_id'       => $this->user_id,
            'des_id'        => null,
            'photo_like'    => 0,
            'internal_url'  => $value
        ]);
        $this->avatar=$photo->photo_id;
        $this->save();
    }

    public function getFullNameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }

    protected static function boot()
    {
        parent::boot();
        /*static::created(function(Ulibier $user){
            if((!Model::isUnguarded())&&(!$user->registered_with_social_account))
                Event::fire(new UlibierRegister($user));
        });*/
    }
}
