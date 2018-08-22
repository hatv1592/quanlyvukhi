<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CovukhiModel
 *
 * @property int nhomvukhi_id
 * @property int covukhi_id
 * @property int covukhi_code
 * @property int covukhi_name
 * @property int covukhi_active
 *
 *
 * @package App\Model
 */
class CovukhiModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'covukhi';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['nhomvukhi_id', 'covukhi_code', 'covukhi_name', 'covukhi_active'];

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'covukhi_id';

    /**
     * Disabled the automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * TODO: Mr. Ha, Plz push your comments for this function
     *
     * @return array
     */
    public static function getArrayHeVuKhi() {
        $hevukhi = \DB::table('covukhi')->get();
        $result = array();
        foreach ($hevukhi as $tung_hevukhi) {
            $result+= array($tung_hevukhi->hevukhi_id => $tung_hevukhi->hevukhi_name);
        }
        return $result;
    }

    /**
     * Set relation with nhomvukhi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nhomvukhi()
    {
        return $this->belongsTo(NhomvukhiModel::class);
    }

    /**
     * Set relation with vukhi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vukhi()
    {
        return $this->hasMany(VukhiModel::class, 'covukhi_id');
    }
}
