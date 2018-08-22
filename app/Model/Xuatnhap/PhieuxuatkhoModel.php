<?php

namespace App\Model\Xuatnhap;

use App\Model\DonviModel;
use Illuminate\Database\Eloquent\Model;

class PhieuxuatkhoModel extends Model
{

    protected $table = 'phieuxuatkho';
    public $timestamps = true;
    public $primaryKey = 'pxk_id';

    //
    public static function pxk_status()
    {
        return array(0 => 'Đang thực hiện', 1 => 'Đã thực hiện', 2 => 'Đã đối soát');
    }

    public function Cancuxuatkho()
    {
        return $this->hasOne('App\Model\Xuatnhap\CancuxuatkhoModel', 'cancuxuatkho_id', 'cancuxuatkho_id');
    }

    public function Lydoxuatkho()
    {
        return $this->hasOne('App\Model\LydoxuatkhoModel', 'lydoxuatkho_id', 'lydoxuatkho_id');
    }

    /**
     * Set relationship with donvi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function DonviXuat()
    {
        return $this->belongsTo(DonviModel::class, 'donvixuat_id');
    }

    public function DonviNhap()
    {
        return $this->hasOne('App\Model\DonviModel', 'donvi_id', 'donvinhap_id');
    }

    public function Phieuxuatkhochitiet()
    {
        return $this->hasMany('App\Model\Xuatnhap\PhieuxuatkhochitietModel', 'pxk_id', 'pxk_id');
    }

    public function Thuclucvukhichitiet()
    {
        return $this->hasMany('App\Model\Xuatnhap\ThuclucvukhichitietModel', 'thuclucvukhi_chitiet_id', 'thuclucvukhi_chitiet_id');
    }

    public static function rulesCreate($input)
    {
        return array(
            'vukhi.nhomvukhi' => 'required|integer',
            'vukhi.covukhi' => 'required|integer',
            'vukhi.vukhi' => 'required|integer',
            'vukhi.nuocsanxuat' => 'required|integer',
            'vukhi.donvitinh' => 'required|integer',
            'phieuxuatkho.donvixuat_id' => 'required|integer',
            'phieuxuatkho.donvinhap_name' => 'required',
            'phieuxuatkho.lydoxuatkho_id' => 'required|integer',
            'phieuxuatkho.pxk_nguoinhan' => 'required',
            'phieuxuatkho.pxk_nguoinhanphieu' => 'required',
            'phieuxuatkho.pxk_nguoiralenh' => 'required',
            'phieuxuatkho.pxk_donvivanchuyen' => 'required',
            'phieuxuatkho.pxk_phuongtienvanchuyen' => 'required',
            'phieuxuatkho.cancuxuatkho_id' => 'required|integer',
        );
    }
    public static function rulesCreateBasic()
    {
        return array(
            'phieuxuatkho.donvixuat_id' => 'required|integer',
            'phieuxuatkho.donvinhap_name' => 'required',
            'phieuxuatkho.lydoxuatkho_id' => 'required|integer',
            'phieuxuatkho.pxk_nguoinhan' => 'required',
            'phieuxuatkho.pxk_nguoinhanphieu' => 'required',
            'phieuxuatkho.pxk_nguoiralenh' => 'required',
            'phieuxuatkho.pxk_donvivanchuyen' => 'required',
            'phieuxuatkho.pxk_phuongtienvanchuyen' => 'required',
            'phieuxuatkho.cancuxuatkho_id' => 'required|integer',
        );
    }

    public static function message($input)
    {
        return array(
            'required' => ':attribute không được để trống',
            'integer' => ':attribute phải là số tự nhiên',
        );
        # validation code
    }

    public static function setAttributeNames()
    {
        return array(
            'vukhi.nhomvukhi' => 'Nhóm vũ khí',
            'vukhi.covukhi' => 'Cỡ vũ khí',
            'vukhi.vukhi' => 'Vũ khí',
            'vukhi.nuocsanxuat' => 'Nước sản xuất',
            'vukhi.donvitinh' => 'Đơn vị tính',
            'phieuxuatkho.donvixuat_id' => 'Đơn vị xuất',
            'phieuxuatkho.donvinhap_name' => 'Đơn vị nhập',
            'phieuxuatkho.lydoxuatkho_id' => 'Lý do xuất kho',
            'phieuxuatkho.pxk_nguoinhan' => 'Người nhận hàng',
            'phieuxuatkho.pxk_nguoinhanphieu' => 'Người nhận phiếu',
            'phieuxuatkho.pxk_nguoiralenh' => 'Thủ trưởng ra lệnh',
            'phieuxuatkho.pxk_donvivanchuyen' => 'Đơn vị vận chuyển',
            'phieuxuatkho.pxk_phuongtienvanchuyen' => 'Phương tiện vận chuyển',
            'phieuxuatkho.cancuxuatkho_id' => 'Căn cứ xuất kho',
        );
    }

}
