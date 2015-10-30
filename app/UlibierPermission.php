<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int permission_id
 * @property bool isAdmin
 */
class UlibierPermission extends Model
{
    //
    protected $table = 'UlibierPermission';
    protected $primaryKey = 'permission_id';

    public function getIsAdminAttribute(){
        return $this->permission_id==1;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(){
        return $this->hasMany('App\Ulibier', 'permission_id', 'permission_id');
    }

    /**
     * @return \Illuminate\Support\Collection|static
     */
    public static function getAdmins(){
        return static::findOrNew(1);
    }

    /**
     * @return \Illuminate\Support\Collection|static
     */
    public static function getUsers(){
        return static::findOrNew(2);
    }
}
