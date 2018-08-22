<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUserModel extends Model
{

    public $timestamps = false;
    protected $table = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];

    /**
     * Check role category manager
     *
     * @var array
     */
    public static function listRole()
    {
        return array(
            1 => 'System Manager',
            2 => 'User Manager',
            3 => 'Backup Manager',
            4 => 'Category Manager',
        );
    }


    /**
     * Check role cat manager
     * @param $user_id
     * @return bool
     */
    public static function hasRoleCatManager($user_id)
    {
        $role = RoleUserModel::where('user_id', $user_id)
            ->where('role_id', 3)
            ->first();
        if ($role) {
            return true;
        }
        return false;
    }

    /**
     * Check role cat manager
     * @param $user_id
     * @return bool
     */
    public static function hasRoleBackupManager($user_id)
    {
        $role = RoleUserModel::where('user_id', $user_id)
            ->where('role_id', 1)
            ->first();
        if ($role) {
            return true;
        }
        return false;
    }

    /**
     * Check role cat manager
     * @param $user_id
     * @return bool
     */
    public static function hasRoleUserManager($user_id)
    {
        $role = RoleUserModel::where('user_id', $user_id)
            ->where('role_id', 1)
            ->first();
        if ($role) {
            return true;
        }
        return false;
    }

    /**
     * Check role cat manager
     * @param $user_id
     * @return bool
     */
    public static function hasSystemManager($user_id)
    {
        $role = RoleUserModel::where('user_id', $user_id)
            ->where('role_id', 1)
            ->first();
        if ($role) {
            return true;
        }
        return false;
    }

}
