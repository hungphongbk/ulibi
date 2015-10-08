<?php

namespace App;

use App\Events\UlibierRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Event;

/**
 * App\Ulibier
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $sex
 * @property string $birthday
 * @property string $email
 * @property string $phonenumber
 * @property string $nationality
 * @property string $username
 * @property string $password
 * @property string $blog_url
 * @property string $report
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|Models\Article[] $articles
 * @property-read mixed $avatar_url
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
    use Authenticatable, CanResetPassword;

    protected $table = 'Ulibier';
    protected $primaryKey = 'user_id';
    protected $fillable = ['firstname','lastname','username', 'email', 'password'];
    protected $hidden = ['user_id', 'password', 'created_at', 'updated_at', 'avatar'];
    protected $appends = ['avatar_url'];

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
        if ($this->avatar==NULL) return '';
        $avatar = Models\Photo::find($this->avatar);
        return $avatar->photo_awss3_url;
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function(Ulibier $user){
            if(!Model::isUnguarded())
                Event::fire(new UlibierRegister($user));
        });
    }
}
