<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VukhiModel
 *
 * @property int covukhi_id
 * @property int vukhi_code
 * @property string vukhi_name
 * @property string vukhi_kyhieu
 * @property float vukhi_trongluong
 * @property float vukhi_dai
 * @property float vukhi_rong
 * @property int vukhi_cao
 *
 * @package App\Model
 */
class VukhiModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'vukhi';

    /**
     * Specify these will be fill data
     *
     * @var array
     */
    protected $fillable = [
        'covukhi_id',
        'vukhi_code',
        'vukhi_name',
        'vukhi_kyhieu',
        'vukhi_trongluong',
        'vukhi_dai',
        'vukhi_rong',
        'vukhi_cao',
        'vukhi_active'
    ];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'vukhi_id';

    /**
     * Disabled the automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * TODO: plz put your comments
     *
     * @return array
     */
    public static function getArrayHeVuKhi()
    {
        $hevukhi = \DB::table('vukhi')->get();
        $result = array();
        foreach ($hevukhi as $tung_hevukhi) {
            $result += array($tung_hevukhi->hevukhi_id => $tung_hevukhi->hevukhi_name);
        }
        return $result;
    }

    /**
     * Get vuKhi
     * @return array
     */
    public static function getArrayVuKhi()
    {
        $result = [];
        $model = self::all();
        foreach ($model as $vuKhi) {
            $result += array($vuKhi->vukhi_id => $vuKhi->vukhi_name);
        }
        return $result;
    }


    /**
     * TODO: Plz put your comments
     *
     * @param array $options
     *
     * @return mixed
     */
    public static function getNameByIds($options = array())
    {
        if ($options['ids']) {
            return VukhiModel::find($options['ids'])->vukhi_name;
        }
    }

    /**
     * Set relation with covukhi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function covukhi()
    {
        return $this->belongsTo(CovukhiModel::class);
    }
}
