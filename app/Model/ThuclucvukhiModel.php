<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThuclucvukhiModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'thuclucvukhi';

    /**
     * Disabled the mode auto create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'thuclucvukhi_id';


    protected $fillable = array(
        'hevukhi_id',
        'nhomvukhi_id',
        'covukhi_id',
        'vukhi_id',
        'nuocsanxuat_id',
        'donvitinh_id',
        'soluong',
        'cohom',
        'trengia',
        'kekich',
        'Chiendau',
        'hlnt',
        'Kho',
        'donvi_id',
    );
    /**
     * Mr. Ha, put here your comments
     *
     * @return array
     */
    public static function setAttributeNames()
    {
        return array(
            'nhapTonDau.hevukhi' => 'Hệ vũ khí',
            'nhapTonDau.nhomvukhi' => 'Nhóm vũ khí',
            'nhapTonDau.covukhi' => 'Cỡ vũ khí',
            'nhapTonDau.vukhi' => 'Vũ khí',
            'nhapTonDau.nuocsanxuat' => 'Nước sản xuất',
            'nhapTonDau.donvitinh' => 'Đơn vị tính',
            'nhapTonDau.donvi' => 'Đơn vị',
        );
    }

    /**
     * TODO: Use ralation name below "thuclucvukhichitiet"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Model\ThuclucvukhichitietModel', 'thuclucvukhi_id');
    }

    public static function rulesCreate($input)
    {
        return array(
            'nhapTonDau.nhomvukhi' => 'required|integer',
            'nhapTonDau.covukhi' => 'required|integer',
            'nhapTonDau.vukhi' => 'required|integer',
            'nhapTonDau.nuocsanxuat' => 'required|integer',
            'nhapTonDau.donvitinh' => 'required|integer',
            'nhapTonDau.donvi' => 'required|integer',
        );

        # validation code
    }

    public static function message($input)
    {
        return array(
            'required' => ':attribute không được để trống',
            'integer' => ':attribute phải là số tự nhiên',
        );
        # validation code
    }

    //
    //Kiểm tra xem nhập tồn đầu đã tồn tại hay chưa
    //
    public static function checkExitsRecord($input)
    {
        $exits = ThuclucvukhiModel::where('donvi_id', '=', $input['donvi'])
            ->where('nuocsanxuat_id', '=', $input['nuocsanxuat'])
            ->where('donvitinh_id', '=', $input['donvitinh'])
            ->where('vukhi_id', '=', $input['vukhi'])
            ->first();
        if (isset($exits)) {
            return true;
        }
    }

    /**
     * Set relation with thuclucvukhichitiet table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thuclucvukhichitiet()
    {
        return $this->hasMany(ThuclucvukhichitietModel::class, 'thuclucvukhi_id');
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

    /**
     * Set relationship with donvi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donvi()
    {
        return $this->belongsTo(DonviModel::class, 'donvi_id');
    }
}
