<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThuclucvukhichitietModel extends Model
{

    public $timestamps = false;
    protected $table = 'thuclucvukhi_chitiet';
    public $primaryKey = 'thuclucvukhi_chitiet_id';
    protected $fillable = array(
        'thuclucvukhi_id',
        'phancap_id',
        'soluong',
        'hevukhi_id',
        'nhomvukhi_id',
        'covukhi_id',
        'vukhi_id',
        'nuocsanxuat_id',
        'donvitinh_id',
        'cohom',
        'trengia',
        'kekich',
        'chiendau',
        'hluyen_ntruong',
        'trongkho',
        'donvi_id'
    );

    public function post()
    {
        return $this->belongsTo('App\Model\ThuclucvukhiModel');
    }

    public function donvi()
    {
        return $this->hasOne('App\Model\DonviModel', 'donvi_id', 'donvi_id');
    }
    public function vukhi()
    {
        return $this->hasOne('App\Model\VuKhiModel', 'vukhi_id', 'vukhi_id');
    }

    public function nuocsanxuat()
    {
        return $this->hasOne('App\Model\NuocsanxuatModel', 'nuocsanxuat_id', 'nuocsanxuat_id');
    }
    public function donViTinh()
    {
        return $this->hasOne('App\Model\DonvitinhModel', 'donvitinh_id', 'donvitinh_id');
    }

    public static function validate($input)
    {
        $rules = array(
            'real_name' => 'Required|Min:3|Max:80|Alpha',
            'email' => 'Required|Between:3,64|Email|Unique:users',
            'age' => 'Integer|Min:18',
            'password' => 'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation' => 'Required|AlphaNum|Between:4,8'
        );

        # validation code
    }


}
