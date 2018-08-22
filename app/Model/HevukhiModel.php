<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class HevukhiModel
 *
 * @property int $hevukhi_id
 * @property int $hevukhi_code
 * @property string $hevukhi_name
 * @property int $hevukhi_active
 *
 * @package App\Model
 */
class HevukhiModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'hevukhi';

    /**
     * @var array
     */
    protected $fillable = ['hevukhi_code', 'hevukhi_name', 'hevukhi_active'];

    /**
     * Set primary key
     *
     * @var string
     */
    protected $primaryKey = 'hevukhi_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    // TODO: set validate for model

    protected $rules = array(
        'hevukhi_code' => 'required',
        'hevukhi_name' => 'required',
    );

    protected $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors;
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    //
    public static function getArrayHeVuKhi()
    {
        $hevukhi = \DB::table('hevukhi')->get();
        $result = array('' => 'Chọn');
        foreach ($hevukhi as $tung_hevukhi) {
            $result += array($tung_hevukhi->hevukhi_id => $tung_hevukhi->hevukhi_name);
        }
        return $result;
    }

    /**
     * Set relationship with nhomvukhi table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nhomvukhi()
    {
        return $this->hasMany(NhomvukhiModel::class, 'hevukhi_id');
    }

    /**
     * Set relationship with nuocsanxuat table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nuocsanxuat()
    {
        return $this->hasMany(NuocsanxuatModel::class, 'hevukhi_id');
    }
    
    /**
     * @Get Hevukhi By donvi_id
     */
    public static function getHeVuKhiByDonViId($donVi_Id)
    {
        $hevukhi = \DB::table('hevukhi')
            ->leftJoin('thuclucvukhi', 'hevukhi.hevukhi_id', '=', 'thuclucvukhi.hevukhi_id')
            ->where('thuclucvukhi.donvi_id', '=', $donVi_Id)
            ->get();
        $result = array('' => 'Chọn');
        if (count($hevukhi)) {
            foreach ($hevukhi as $tung_hevukhi) {
                $result += array($tung_hevukhi->hevukhi_id => $tung_hevukhi->hevukhi_name);
            }
        }
        return $result;
    }
}
