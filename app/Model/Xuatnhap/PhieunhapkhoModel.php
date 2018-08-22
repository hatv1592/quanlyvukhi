<?php

namespace App\Model\Xuatnhap;

use App\Model\DonviModel;
use Illuminate\Database\Eloquent\Model;

class PhieunhapkhoModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'phieunhapkho';

    /**
     * Specify these fields that will be fill data
     *
     * @var array
     */
    protected $fillable = [
        'cancunhapkho_id',
        'donvi_id',
        'lydonhapkho_id',
        'donvixuat_name',
        'pnk_ngay_tao',
        'pnk_ngay_hethan',
        'pnk_donvivanchuyen',
        'pnk_nguoinhanhang',
        'pnk_phuongtienvanchuyen',
        'pnk_nguoinhanphieu',
        'pnk_nguoiralenh',
        'pnk_status',
        'pnk_sophieu',
        'pnk_code',
        'pnk_type'
    ];

    /**
     * Enabled the mode auto create timestamp
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Specify primary key for this table
     *
     * @var string
     */
    public $primaryKey = 'pnk_id';

    /**
     * Auto delete all relationship when a pnk is deleted
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($phieunhapkho) {
            $phieunhapkho->Phieunhapkhochitiet()->delete();
        });

        static::updating(function($phieunhapkho) {
            $phieunhapkho->Phieunhapkhochitiet()->delete();
        });
    }

    //
    public static function pnk_status()
    {
        return array(0 => 'Đang thực hiện', 1 => 'Đã thực hiện');
    }

    public function Cancunhapkho()
    {
        return $this->hasOne('App\Model\Xuatnhap\CancunhapkhoModel', 'cancunhapkho_id', 'cancunhapkho_id');
    }
    public function Lydonhapkho()
    {
        return $this->hasOne('App\Model\LydonhapkhoModel', 'lydonhapkho_id', 'lydonhapkho_id');
    }
    public function DonviXuat()
    {
        return $this->hasOne('App\Model\DonviModel', 'donvi_id', 'donvinhap_id');
    }

    /**
     * Set relationship with donvi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function DonviNhap()
    {
        return $this->belongsTo(DonviModel::class, 'donvi_id');
    }

    public function Phieunhapkhochitiet(){
        return $this->hasMany('App\Model\Xuatnhap\PhieunhapkhochitietModel', 'pnk_id', 'pnk_id');
    }
    public function Thuclucvukhichitiet(){
        return $this->hasMany('App\Model\Xuatnhap\ThuclucvukhichitietModel', 'thuclucvukhi_chitiet_id', 'thuclucvukhi_chitiet_id');
    }
}
