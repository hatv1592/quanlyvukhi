<?php

namespace App\Model\Xuatnhap;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancuxuatkhoModel
 *
 * @property int cancuxuatkho_id
 * @property string cancuxuatkho_name
 * @property string cancuxuatkho_code
 * @property string cancuxuatkho_number
 * @property string cancuxuatkho_cqralenh
 * @property string cancuxuatkho_note
 * @property int cancuxuatkho_active
 * @property int cancuxuatkho_type
 * @property Date cancuxuatkho_date
 *
 * @package App\Model\Xuatnhap
 */
class CancuxuatkhoModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'cancuxuatkho';

    /**
     * Specify these fields that will be fill data
     *
     * @var array
     */
    protected $fillable = [
        'cancuxuatkho_name',
        'cancuxuatkho_cqralenh',
        'cancuxuatkho_code',
        'cancuxuatkho_number',
        'cancuxuatkho_date',
        'cancuxuatkho_note',
        'cancuxuatkho_active'
    ];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'cancuxuatkho_id';

    /**
     * Disabled auto create timestamp
     *
     * @var bool
     */
    public $timestamps = false;


    //
    public static function pxk_status()
    {
        return array(0 => 'Đang thực hiện', 1 => 'Đã thực hiện');
    }

    public static function getArrayCanCuXuatKho()
    {
        $model = self::where('cancuxuatkho_active', 1)->get();
        $result = array('' => 'Chọn');
        if ($model) {
            foreach ($model as $canCuXuatKho) {
                $result += array($canCuXuatKho->cancuxuatkho_id => $canCuXuatKho->cancuxuatkho_name);
            }
        }
        return $result;
    }
}
