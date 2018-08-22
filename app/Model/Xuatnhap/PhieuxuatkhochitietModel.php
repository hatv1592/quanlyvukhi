<?php

namespace App\Model\Xuatnhap;

use Illuminate\Database\Eloquent\Model;

class PhieuxuatkhochitietModel extends Model
{


    protected $table = 'pxk_chitiet';
    public $timestamps = false;
    public $primaryKey = 'pxk_chitiet_id';
    protected $fillable = array('pnk_id',
        'vukhi_id',
        'nuocsanxuat_id',
        'donvitinh_id',
        'phancap_id',
        'soluong_kehoach',
        'soluong_thucxuat');


    public function thucLucVuKhiChiTiet()
    {
        return $this->hasOne('App\Model\ThuclucvukhichitietModel','thuclucvukhi_chitiet_id','thuclucvukhi_chitiet_id');
    }

}
