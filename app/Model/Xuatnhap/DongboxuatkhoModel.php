<?php

namespace App\Model\Xuatnhap;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DongboxuatkhoModel
 *
 * @property int dongbo_xuat_id
 * @property string donvi_id
 * @property string cancuxuatkho_number
 * @property string pxk_id
 * @property string hevukhi_id
 * @property Date nhomvukhi_id
 * @property string phancap_id
 * @property int cancunhapkho_active
 *
 * @package App\Model\Xuatnhap
 */
class CancunhapkhoModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'dongbo_xuatkho';

    /**
     * Specify these fields that will be fill data
     *
     * @var array
     */
//    protected $fillable = [
//        'cancunhapkho_name',
//        'cancunhapkho_coquan',
//        'cancunhapkho_code',
//        'cancunhapkho_number',
//        'cancunhapkho_date',
//        'cancunhapkho_note',
//        'cancunhapkho_active'
//    ];

    /**
     * Specify primary key
     *
     * @var string
     */
    public $primaryKey = 'cancunhapkho_id';

    /**
     * Disabled mode auto create timestamp
     *
     * @var bool
     */
    public $timestamps = false;
}
