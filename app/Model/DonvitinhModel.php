<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DonvitinhModel
 *
 * @property int donvitinh_id
 * @property string donvitinh_name
 * @property int donvitinh_active
 *
 * @package App\Model
 */
class DonvitinhModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'donvitinh';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['donvitinh_name', 'donvitinh_active'];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'donvitinh_id';

    /**
     * Disabled the automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get All don vi tinh
     *
     * @return array
     */
    public static function getArrayDonViTInh()
    {
        $donvitinh = \DB::table('donvitinh')->get();
        $result = array();
        foreach ($donvitinh as $tung_donvitinh) {
            $result += array($tung_donvitinh->donvitinh_id => $tung_donvitinh->donvitinh_name);
        }
        return $result;
    }

    /**
     * get Name By Ids
     *
     * @param array $options
     * @return mixed
     */
    public static function getNameByIds($options = array())
    {
        if ($options['ids']) {
            return DonvitinhModel::find($options['ids'])->donvitinh_name;
        }
    }
}
