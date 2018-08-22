<?php

namespace App\Model\Xuatnhap;

use App\Model\DonvitinhModel;
use App\Model\NuocsanxuatModel;
use App\Model\VukhiModel;
use Illuminate\Database\Eloquent\Model;

class PhieunhapkhochitietModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'pnk_chitiet';

    /**
     * @var array
     */
    protected $fillable = [
        'pnk_id',
        'vukhi_id',
        'nuocsanxuat_id',
        'donvitinh_id',
        'phancap_id',
        'soluong_kehoach',
        'soluong_thucnhap'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    public $primaryKey = 'pnk_chitiet_id';

    /**
     * Set relationship with thuclucvukhi_chitiet table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thucLucVuKhiChiTiet()
    {
        return $this->hasOne('App\Model\ThuclucvukhichitietModel','thuclucvukhi_chitiet_id','thuclucvukhi_chitiet_id');
    }

    /**
     * Set relationship with vukhi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vukhi()
    {
        return $this->belongsTo(VukhiModel::class, 'vukhi_id');
    }

    /**
     * Set relationship with nuocsanxuat table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nuocsanxuat()
    {
        return $this->belongsTo(NuocsanxuatModel::class, 'nuocsanxuat_id');
    }

    /**
     * Set relationship with donvitinh table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donvitinh()
    {
        return $this->belongsTo(DonvitinhModel::class, 'donvitinh_id');
    }
}
