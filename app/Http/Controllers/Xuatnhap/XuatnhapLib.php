<?php
namespace App\Http\Controllers\Xuatnhap;

use App\Model\SoPhieuModel;
use DB;

class XuatnhapLib
{
    const SOPHIEU_TYPE_PHIEUNHAP = 1;
    const SOPHIEU_TYPE_PHIEUXUAT = 2;

    /**
     * @todo L?y mã phi?u nh?p kho và s? phi?u nh?p kho t? ??ng
     * @param $short_name_donvi
     * @return array:2 [?
     * "sophieu" => "5/NK-2016"
     * "code" => "PT-5/NK-2016"
     * ]
     */
    public function getAutoCodeImport($short_name_donvi)
    {
        return $this->_createAutoCodeMonthly(self::SOPHIEU_TYPE_PHIEUNHAP, $short_name_donvi);
    }

    /**
     * @todo L?y mã phi?u xu?t kho và s? phi?u xu?t kho t? ??ng
     * @param $short_name_donvi
     * @return array:2 [?
     * "sophieu" => "5/XK-2016"
     * "code" => "PT-5/XK-2016"
     * ]
     */
    public function getAutoCodeExport($short_name_donvi)
    {
        return $this->_createAutoCodeMonthly(self::SOPHIEU_TYPE_PHIEUXUAT, $short_name_donvi);
    }

    private function _createAutoCodeMonthly($type, $short_name_donvi)
    {
        $year = date('Y');
        $key = $year . $type;
        SoPhieuModel::updateOrCreate(['sophieu_key' => $key], ['sophieu_stt' => DB::raw(' sophieu_stt + 1 '), 'sophieu_year' => $year]);

        $incr_value = SoPhieuModel::where('sophieu_year', $year)->where('sophieu_key', $key)->value('sophieu_stt');

        if ($type == self::SOPHIEU_TYPE_PHIEUNHAP) {
            $sophieu = $incr_value . '/NK-' . $year;
        } else {
            $sophieu = $incr_value . '/XK-' . $year;
        }

        $code = $short_name_donvi . '-' . $sophieu;

        return ['sophieu' => $sophieu, 'code' => $code];
    }
}
