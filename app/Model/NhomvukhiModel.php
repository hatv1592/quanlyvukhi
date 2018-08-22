<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NhomvukhiModel
 *
 * @property int hevukhi_id
 * @property int nhomvukhi_id
 * @property string nhomvukhi_code
 * @property string nhomvukhi_name
 * @property int nhomvukhi_active
 *
 * @package App\Model
 */
class NhomvukhiModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'nhomvukhi';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['hevukhi_id', 'nhomvukhi_code', 'nhomvukhi_name', 'nhomvukhi_active'];

    /**
     * Disabled automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set primary key for this table
     *
     * @var string
     */
    public $primaryKey = 'nhomvukhi_id';

    /**
     * TODO: Mr. Ha, Could you plz put your comments to explain for this function?
     *
     * @return array
     */
    public static function getArrayNhomVuKhi()
    {
        $nhomvukhi = \DB::table('nhomvukhi')->get();
        $result = array('' => 'Chọn');
        foreach ($nhomvukhi as $tung_nhomvukhi) {
            $result += array($tung_nhomvukhi->nhomvukhi_id => $tung_nhomvukhi->nhomvukhi_name);
        }
        return $result;
    }

    /**
     * Set relation with hevukhi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hevukhi()
    {
        return $this->belongsTo(HevukhiModel::class);
    }

    /**
     * Set relationship with covukhi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function covukhi()
    {
        return $this->hasMany(CovukhiModel::class, 'nhomvukhi_id');
    }
}
