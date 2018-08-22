<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DonviModel
 *
 * @property int donvi_id
 * @property int donvi_parent
 * @property string donvi_name
 * @property int donvi_level
 * @property string donvi_short_name
 *
 * @package App\Model
 */
class DonviModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'donvi';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['donvi_parent', 'donvi_name', 'donvi_level', 'donvi_short_name'];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'donvi_id';

    /**
     * Disabled the automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

   /**
     * Get all don vi nhap
     * @param int $parent 1 nhập -  2 xuat
     * @return array
     */
    public static function getArrayDonvi($parent = null)
    {
        if ($parent) {
            $model = DonviModel::where('donvi_parent', $parent)->get();
        } else {
            $model = DonviModel::all();
        }
        $result = array('' => 'Chọn');
        foreach ($model as $donVi) {
            $result += array($donVi->donvi_id => $donVi->donvi_name);
        }
        return $result;
    }


    public static function getNameByIds($options = array())
    {
        if ($options['ids']) {
            return DonviModel::find($options['ids'])->donvi_name;
        }
    }

    /**
     * Set recursive relationships
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo($this, 'donvi_parent', 'donvi_id');
    }
}
