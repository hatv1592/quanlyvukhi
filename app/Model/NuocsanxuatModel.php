<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NuocsanxuatModel
 *
 * TODO: need to refactor name of model to NuocSanXuatModel || NuocSanXuat(recommended)
 *
 * @property int nuocsanxuat_id
 * @property int hevukhi_id
 * @property string nuocsanxuat_name
 * @property int nuocsanxuat_active
 *
 * @package App\Model
 */
class NuocsanxuatModel extends Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'nuocsanxuat';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['hevukhi_id', 'nuocsanxuat_name', 'nuocsanxuat_active'];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'nuocsanxuat_id';

    /**
     * Disabled automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * TODO: Mr. Ha, plz put your comments to explain for this function
     *
     * @param array $options
     * @return mixed
     */
    public static function getNameByIds($options = array())
    {

        $a = array(
            1665 => '3',
            11570 => '3',
            2746 => '3',
            0 => '3',
            596 => '3',
            7100 => '3',
            11030 => '3',
            990 => '3'
        );


        if ($options['ids']) {
            return NuocsanxuatModel::find($options['ids'])->nuocsanxuat_name;
        }
    }

    /**
     * Get vuKhi
     * @return array
     */
    public static function getArrayNuocSanXuat()
    {
        $result = [];
        $model = self::all();
        foreach ($model as $nuocSanXuat) {
            $result += array($nuocSanXuat->nuocsanxuat_id => $nuocSanXuat->nuocsanxuat_name);
        }
        return $result;
    }
    /**
     * Set relation with hevukhi
     *
     * TODO: A country may be have many weapon system...need to confirm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hevukhi()
    {
        return $this->belongsTo(HevukhiModel::class);
    }
}
