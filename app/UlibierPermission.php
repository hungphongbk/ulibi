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
}
