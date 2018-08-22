<?php

namespace App;

use App\Model\RoleUserModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function isSuperAdmin()
    {
        if (Auth::guard()->check()) {
            if (Auth::guard()->user()->role == 9)
                return true;
        }
        return false;
    }

    public static function isUser()
    {
        if (Auth::guard()->check()) {
            if (Auth::guard()->user()->role >= 5)
                return true;
        }
        return false;
    }

    public static function isReader()
    {
        if (Auth::guard()->check()) {
            if (Auth::guard()->user()->role == 1)
                return true;
        }
        return false;
    }

    public static function setAttributeNames()
    {
        return array(
            'user_name' => 'Tên người dùng',
            'user_password' => 'Mật khẩu',
            'user_password_re' => 'Mật khẩu',
            'user_email' => 'Email',
            'role' => 'Quyền',
        );
    }

    public static function rulesCreate($input, $id = null)
    {
        if ($input == 'create') {
            return array(
                'user_name' => 'required',
                'user_password' => 'min:6|required',
                'user_password_re' => 'min:6|same:user_password|required',
                'user_email' => 'required|unique:users,email|email',
                'role' => 'required|integer',
            );
        } else {
            return array(
                'user_name' => 'required',
                'user_email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|integer'
            );
        }

        # validation code
    }

    public static function message($input)
    {
        return array(
            'required' => ':attribute không được để trống',
            'unique' => ':attribute phải là số tự nhiên',
            'same' => ':attribute không trùng khớp',
            'min' => ':attribute tối thiểu phải 6 kí tự',
            'integer' => ':attribute phải là dạng số',
        );
        # validation code
    }

}
