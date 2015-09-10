<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Ulibier extends Model  implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'Ulibier';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['user_id', 'password', 'created_at', 'updated_at'];

    /**
     * Get all articles this user wrote
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles() {
        return $this->hasMany(Models\Article::class ,'user_id','user_id');
    }
}
