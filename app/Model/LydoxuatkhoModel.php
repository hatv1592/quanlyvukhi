<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LydoxuatkhoModel extends Model
{

    public $timestamps = false;
    public $primaryKey = 'lydoxuatkho_id';
    protected $table = 'lydoxuatkho';

    /**
     * Get all ly do xuat kho
     *
     * @return array
     */
    public static function getArrayLyDoXuatKho()
    {
        $model = LydoxuatkhoModel::all();
        $result = array('' => 'Chọn');
        foreach ($model as $lyDoXuatKho) {
            $result += array($lyDoXuatKho->lydoxuatkho_id => $lyDoXuatKho->lydoxuatkho_name);
        }
        return $result;
    }
    //
}
