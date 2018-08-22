<?php
namespace App\Services;


use App\Model\DonviModel;
use App\Model\LydonhapkhoModel;
use App\Model\LydoxuatkhoModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use Carbon\Carbon;
use DB;
function pd($x) {
    echo '<pre>';
    print_r($x);
    die();
}
class ReportService
{
    private $donvi_id = 0;
    public $groupByReason = false;

    public function prepareReportInput(&$aryData)
    {
        $aryData['input'] = request('input', []);

        $date = Carbon::createFromFormat('d/m/Y', trim($aryData['input']['from_date']));
        $aryData['input']['from_time_stamp'] = $date->timestamp;
        $aryData['input']['from_date_db'] = $date->format('Y-m-d');

        $date = Carbon::createFromFormat('d/m/Y H:i:s', trim($aryData['input']['to_date'] . ' 23:59:59'));
        $aryData['input']['to_time_stamp'] = $date->timestamp;
        $aryData['input']['to_date_db'] = $date->format('Y-m-d');

        $aryData['input']['donvi_id'] = $this->donvi_id = (int)$aryData['input']['donvi_id'];
        $aryData['input']['donvi_name'] = ($this->donvi_id > 0) ? DonviModel::where('donvi_id', $this->donvi_id)->value('donvi_name') : 'Tất cả đơn vị';

        if ($aryData['input']['from_time_stamp'] >= $aryData['input']['to_time_stamp']) {
            throw new \Exception('Dữ liệu đầu vào không đúng. Ngày cuối kỳ báo cáo không thể trước ngày đầu kỳ báo cáo. Đồng chí vui lòng nhập lại dữ liệu');
        } elseif ($aryData['input']['to_time_stamp'] >= strtotime('tomorrow')) {
            throw new \Exception('Dữ liệu đầu vào không đúng. Ngày cuối kỳ báo cáo không thể sau ngày HÔM NAY. Đồng chí vui lòng nhập lại dữ liệu');
        }
    }

    public function prepareDataOutput(&$aryData)
    {
        $tModel = new ThuclucvukhichitietModel();
        if ($this->donvi_id > 0) {
            $currentThucLuc = $tModel->where('donvi_id', $this->donvi_id);
        } else {
            $currentThucLuc = $tModel->select(
                [
//                    'thuclucvukhi_chitiet.*',
                    'thuclucvukhi_chitiet.thuclucvukhi_id',
                    'thuclucvukhi_chitiet.soluong',
                    'thuclucvukhi_chitiet.donvi_id',
                    'thuclucvukhi_chitiet.phancap_id',
                    'vukhi.vukhi_id',
                    'vukhi.vukhi_name',
                    'nuocsanxuat.nuocsanxuat_id',
                    'nuocsanxuat.nuocsanxuat_name',
                    'donvitinh.donvitinh_id',
                    'donvitinh.donvitinh_name',
                    DB::raw(' sum(soluong) as soluong ')
                ]
            );
            $currentThucLuc->groupBy('thuclucvukhi_chitiet.nuocsanxuat_id')->groupBy('thuclucvukhi_chitiet.vukhi_id')->groupBy('thuclucvukhi_chitiet.donvitinh_id')->groupBy('thuclucvukhi_chitiet.phancap_id');
        }
        $currentThucLuc->leftJoin('vukhi', 'vukhi.vukhi_id', '=', 'thuclucvukhi_chitiet.vukhi_id');
        $currentThucLuc->leftJoin('nuocsanxuat', 'nuocsanxuat.nuocsanxuat_id', '=', 'thuclucvukhi_chitiet.nuocsanxuat_id');
        $currentThucLuc->leftJoin('donvitinh', 'donvitinh.donvitinh_id', '=', 'thuclucvukhi_chitiet.donvitinh_id');

        $aryData['current'] = $currentThucLuc->get();
        if (!empty($aryData['current'])) {
            $aryData['current'] = $aryData['current']->toArray();
        } else {
            $aryData['current'] = [];
        }

        $aryData['out_of_date_import'] = $this->_getDataByPhieuNhapKho($aryData['input']['to_date_db'], date('Y-m-d'), false);
        $aryData['out_of_date_export'] = $this->_getDataByPhieuXuatKho($aryData['input']['to_date_db'], date('Y-m-d'), false);

        if ($this->groupByReason) {
            $aryData['pxk'] = $this->_getDataByPhieuXuatKhoReason($aryData['input']['from_date_db'], $aryData['input']['to_date_db']);
            $aryData['pnk'] = $this->_getDataByPhieuNhapKhoReason($aryData['input']['from_date_db'], $aryData['input']['to_date_db']);
            $this->_groupVuKhiByReason($aryData);

            $aryData['aryLyDoXuatKhoTemplate'] = [];
            $aryData['aryLyDoXuatKho'] = LydoxuatkhoModel::whereIn('lydoxuatkho_id', $aryData['aryLyDoXuatKho'])->lists('lydoxuatkho_name', 'lydoxuatkho_id')->toArray();
            foreach ($aryData['aryLyDoXuatKho'] as $k => $v) {
                $aryData['aryLyDoXuatKhoTemplate'][$k] = 0;
            }
            $aryData['aryLyDoNhapKhoTemplate'] = [];
            $aryData['aryLyDoNhapKho'] = LydonhapkhoModel::whereIn('lydonhapkho_id', $aryData['aryLyDoNhapKho'])->lists('lydonhapkho_name', 'lydonhapkho_id')->toArray();
            foreach ($aryData['aryLyDoNhapKho'] as $k => $v) {
                $aryData['aryLyDoNhapKhoTemplate'][$k] = 0;
            }
//            dd($aryData['aryLyDoXuatKho']);
        } else {
            $aryData['pxk'] = $this->_getDataByPhieuXuatKho($aryData['input']['from_date_db'], $aryData['input']['to_date_db']);
            $aryData['pnk'] = $this->_getDataByPhieuNhapKho($aryData['input']['from_date_db'], $aryData['input']['to_date_db']);
            $this->_groupVuKhi($aryData);
        }
        /*echo '<pre>';
        foreach($aryData['current'] as $v) {
            print_r($v);
        }

        dd($aryData['current']);*/
//        $temp = [];
//        foreach ($currentThucLuc as $v) {
//            print_r($v->thuclucvukhi_chitiet_id . '<br/>');
//            $temp[$v->vukhi_id][$v->nuocsanxuat_id][$v->donvitinh_id][$v->phancap_id]
//        }
//        die();

    }

    private function _groupVuKhi(&$aryData)
    {
        $sum = [];
        $data = [];

        foreach ($aryData['current'] as $v) {
            $v['soluong_thucxuat'] = isset($aryData['pxk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat']) ?
                $aryData['pxk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat'] : 0;

            $v['soluong_thucnhap'] = isset($aryData['pnk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap']) ?
                $aryData['pnk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap'] : 0;

            $out_of_date_import = isset($aryData['out_of_date_import'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap']) ? $aryData['out_of_date_import'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap'] : 0;
            $out_of_date_export = isset($aryData['out_of_date_export'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat']) ? $aryData['out_of_date_export'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat'] : 0;

            $v['soluong_cuoi_ky'] = $v['soluong'] + $out_of_date_export - $out_of_date_import;//Số dư cuối kỳ = Số dư hiện tại + xuất ngoài kỳ - nhập ngoài kỳ
            $v['soluong_dauky'] = $v['soluong_cuoi_ky'] + $v['soluong_thucxuat'] - $v['soluong_thucnhap'];//Số dư đầu kỳ = Số dư cuối kỳ + xuất trong kỳ - nhập trong kỳ

            if (isset($sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'])) {
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'] += $v['soluong_cuoi_ky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat'] += $v['soluong_thucxuat'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap'] += $v['soluong_thucnhap'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_dauky'] += $v['soluong_dauky'];
            } else {
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'] = $v['soluong_cuoi_ky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat'] = $v['soluong_thucxuat'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap'] = $v['soluong_thucnhap'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_dauky'] = $v['soluong_dauky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['row'] = $v;
            }
            $data[$v['vukhi_id']][] = $v;
        }
        $aryData['sum'] = $sum;
        $aryData['data'] = $data;

//        pd($aryData);

        unset($aryData['pxk_end_to_now']);
        unset($aryData['pnk_end_to_now']);
        unset($aryData['current']);
        unset($aryData['pxk']);
        unset($aryData['pnk']);
        unset($sum);
    }

    private function _groupVuKhiByReason(&$aryData)
    {
        $sum = [];
        $data = [];
        $aryData['aryLyDoXuatKho'] = [];
        $aryData['aryLyDoNhapKho'] = [];
        foreach ($aryData['current'] as $v) {


            $v['soluong_thucxuat'] = 0;
            $v['soluong_thucxuat_lydo'] = [];
            if (isset($aryData['pxk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']])) {
                $temps = $aryData['pxk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']];
                foreach ($temps as $lydoxuat => $temp) {
                    $aryData['aryLyDoXuatKho'][$lydoxuat] = $lydoxuat;
                    $v['soluong_thucxuat_lydo'][$lydoxuat] = $temp['soluong_thucxuat'];
                    $v['soluong_thucxuat'] += $temp['soluong_thucxuat'];
                }
            }

            $v['soluong_thucnhap'] = 0;
            $v['soluong_thucnhap_lydo'] = [];
            if (isset($aryData['pnk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']])) {
                $temps = $aryData['pnk'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']];
                foreach ($temps as $lydonhap => $temp) {
                    $aryData['aryLyDoNhapKho'][$lydonhap] = $lydonhap;
                    $v['soluong_thucnhap_lydo'][$lydonhap] = $temp['soluong_thucnhap'];
                    $v['soluong_thucnhap'] += $temp['soluong_thucnhap'];
                }
            }


            $out_of_date_import = isset($aryData['out_of_date_import'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap']) ? $aryData['out_of_date_import'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucnhap'] : 0;
            $out_of_date_export = isset($aryData['out_of_date_export'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat']) ? $aryData['out_of_date_export'][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']]['soluong_thucxuat'] : 0;

            $v['soluong_cuoi_ky'] = $v['soluong'] + $out_of_date_export - $out_of_date_import;//Số dư cuối kỳ = Số dư hiện tại + xuất ngoài kỳ - nhập ngoài kỳ
            $v['soluong_dauky'] = $v['soluong_cuoi_ky'] + $v['soluong_thucxuat'] - $v['soluong_thucnhap'];//Số dư đầu kỳ = Số dư cuối kỳ + xuất trong kỳ - nhập trong kỳ

            if (isset($sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'])) {
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'] += $v['soluong_cuoi_ky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat'] += $v['soluong_thucxuat'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap'] += $v['soluong_thucnhap'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_dauky'] += $v['soluong_dauky'];
                foreach ($v['soluong_thucxuat_lydo'] as $thucxuat_lydo_id => $soluong_by_lydo) {
                    if (isset($sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat_lydo'][$thucxuat_lydo_id])) {
                        $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat_lydo'][$thucxuat_lydo_id] += $soluong_by_lydo;
                    } else {
                        $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat_lydo'][$thucxuat_lydo_id] = $soluong_by_lydo;
                    }
                }
                foreach ($v['soluong_thucnhap_lydo'] as $thucnhap_lydo_id => $soluong_by_lydo) {
                    if (isset($sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap_lydo'][$thucnhap_lydo_id])) {
                        $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap_lydo'][$thucnhap_lydo_id] += $soluong_by_lydo;
                    } else {
                        $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap_lydo'][$thucnhap_lydo_id] = $soluong_by_lydo;
                    }
                }
            } else {
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_cuoi_ky'] = $v['soluong_cuoi_ky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat'] = $v['soluong_thucxuat'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap'] = $v['soluong_thucnhap'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_dauky'] = $v['soluong_dauky'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucxuat_lydo'] = $v['soluong_thucxuat_lydo'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['soluong_thucnhap_lydo'] = $v['soluong_thucnhap_lydo'];
                $sum[$v['vukhi_id']][$v['phancap_id']]['row'] = $v;
            }
            $data[$v['vukhi_id']][] = $v;
        }
        $aryData['sum'] = $sum;
        $aryData['data'] = $data;

        unset($aryData['pxk_end_to_now']);
        unset($aryData['pnk_end_to_now']);
        unset($aryData['current']);
        unset($aryData['pxk']);
        unset($aryData['pnk']);
        unset($sum);
    }

    /**
     * @param $from
     * @param $to
     * @param bool|true $contain_date_from : Có lấy dữ liệu ngày cả ngày bắt đầu không. Ví dụ $date_from = '2008-11-19', nếu $contain_date_from = false thì ko thấy dữ liệu ngày 2008-11-19
     * @param bool|true $contain_date_to : Có lấy dữ liệu ngày cả ngày kết thúc không.
     * @return array
     */
    private function _getDataByPhieuXuatKho($date_from, $date_to, $contain_date_from = true, $contain_date_to = true)
    {
        $tModel = new PhieuxuatkhoModel();
        $arySelect = [
            'thuclucvukhi_chitiet.vukhi_id',
            'thuclucvukhi_chitiet.nuocsanxuat_id',
            'thuclucvukhi_chitiet.donvitinh_id',
            'thuclucvukhi_chitiet.phancap_id',
            DB::raw(" sum(pxk_chitiet.soluong_thucxuat) as  soluong_thucxuat ")
        ];
        if ($this->donvi_id > 0) {
            $allPXK = $tModel->where('phieuxuatkho.donvixuat_id', $this->donvi_id);
        } else {
            $allPXK = $tModel->where('phieuxuatkho.pxk_type', '=', 0);
        }
        $allPXK->leftJoin('pxk_chitiet', 'phieuxuatkho.pxk_id', '=', 'pxk_chitiet.pxk_id');
        $allPXK->leftJoin('thuclucvukhi_chitiet', 'thuclucvukhi_chitiet.thuclucvukhi_chitiet_id', '=', 'pxk_chitiet.thuclucvukhi_chitiet_id');
        $allPXK->groupBy('thuclucvukhi_chitiet.nuocsanxuat_id')->groupBy('thuclucvukhi_chitiet.vukhi_id')->groupBy('thuclucvukhi_chitiet.donvitinh_id')->groupBy('thuclucvukhi_chitiet.phancap_id');
        $allPXK->where('phieuxuatkho.pxk_ngay_thuchien', (($contain_date_from) ? '>=' : '>'), $date_from);
        $allPXK->where('phieuxuatkho.pxk_ngay_thuchien', (($contain_date_to) ? '<=' : '<'), $date_to);
        $allPXK->where('phieuxuatkho.pxk_status', '>', 0);
        $allPXK->select($arySelect);
        $temp = $allPXK->get();
        $aryData = [];
        if (!empty($temp)) {
            $temp = $temp->toArray();
            foreach ($temp as $v) {
                $aryData[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
            }
        }
        return $aryData;
    }


    private function _getDataByPhieuXuatKhoReason($date_from, $date_to, $contain_date_from = true, $contain_date_to = true)
    {
        $tModel = new PhieuxuatkhoModel();
        $arySelect = [
            'thuclucvukhi_chitiet.vukhi_id',
            'thuclucvukhi_chitiet.nuocsanxuat_id',
            'thuclucvukhi_chitiet.donvitinh_id',
            'thuclucvukhi_chitiet.phancap_id',
            'phieuxuatkho.lydoxuatkho_id',
            DB::raw(" sum(pxk_chitiet.soluong_thucxuat) as  soluong_thucxuat ")
        ];
        if ($this->donvi_id > 0) {
            $allPXK = $tModel->where('phieuxuatkho.donvixuat_id', $this->donvi_id);
        } else {
            $allPXK = $tModel->where('phieuxuatkho.pxk_type', '=', 0);
        }
        $allPXK->leftJoin('pxk_chitiet', 'phieuxuatkho.pxk_id', '=', 'pxk_chitiet.pxk_id');
        $allPXK->leftJoin('thuclucvukhi_chitiet', 'thuclucvukhi_chitiet.thuclucvukhi_chitiet_id', '=', 'pxk_chitiet.thuclucvukhi_chitiet_id');
        $allPXK->groupBy('thuclucvukhi_chitiet.nuocsanxuat_id')->groupBy('thuclucvukhi_chitiet.vukhi_id')->groupBy('thuclucvukhi_chitiet.donvitinh_id')->groupBy('thuclucvukhi_chitiet.phancap_id')->groupBy('phieuxuatkho.lydoxuatkho_id');
        $allPXK->where('phieuxuatkho.pxk_ngay_thuchien', (($contain_date_from) ? '>=' : '>'), $date_from);
        $allPXK->where('phieuxuatkho.pxk_ngay_thuchien', (($contain_date_to) ? '<=' : '<'), $date_to);
        $allPXK->where('phieuxuatkho.pxk_status', '>', 0);
        $allPXK->select($arySelect);
        $temp = $allPXK->get();
        $aryData = [];
        if (!empty($temp)) {
            $temp = $temp->toArray();
            foreach ($temp as $v) {
                $aryData[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']][$v['lydoxuatkho_id']] = $v;
            }
        }
//        dd($aryData);
        return $aryData;
    }

    /**
     * @param $from
     * @param $to
     * @param bool|true $contain_date_from : Có lấy dữ liệu ngày cả ngày bắt đầu không. Ví dụ $date_from = '2008-11-19', nếu $contain_date_from = false thì ko thấy dữ liệu ngày 2008-11-19
     * @param bool|true $contain_date_to : Có lấy dữ liệu ngày cả ngày kết thúc không.
     * @return array
     */
    private function _getDataByPhieuNhapKho($date_from, $date_to, $contain_date_from = true, $contain_date_to = true)
    {
        $tModel = new PhieunhapkhoModel();
        $arySelect = [
            'pnk_chitiet.vukhi_id',
            'pnk_chitiet.nuocsanxuat_id',
            'pnk_chitiet.donvitinh_id',
            'pnk_chitiet.phancap_id',
            DB::raw(" sum(pnk_chitiet.soluong_thucnhap) as  soluong_thucnhap ")
        ];
        if ($this->donvi_id > 0) {
            $allPXK = $tModel->where('phieunhapkho.donvi_id', $this->donvi_id);
        } else {
            $allPXK = $tModel->where('phieunhapkho.pnk_type', '=', 0);
        }
        $allPXK->leftJoin('pnk_chitiet', 'phieunhapkho.pnk_id', '=', 'pnk_chitiet.pnk_id');
        $allPXK->groupBy('pnk_chitiet.nuocsanxuat_id')->groupBy('pnk_chitiet.vukhi_id')->groupBy('pnk_chitiet.donvitinh_id')->groupBy('pnk_chitiet.phancap_id');
        $allPXK->where('phieunhapkho.pnk_ngay_thuchien', (($contain_date_from) ? '>=' : '>'), $date_from);
        $allPXK->where('phieunhapkho.pnk_ngay_thuchien', (($contain_date_to) ? '<=' : '<'), $date_to);
        $allPXK->where('phieunhapkho.pnk_status', '>', 0);
        $allPXK->select($arySelect);
        $temp = $allPXK->get();
        $aryData = [];
        if (!empty($temp)) {
            $temp = $temp->toArray();
            foreach ($temp as $v) {
                $aryData[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
            }
        }
        return $aryData;
    }

    private function _getDataByPhieuNhapKhoReason($date_from, $date_to, $contain_date_from = true, $contain_date_to = true)
    {
//        dd(func_get_args());

        $tModel = new PhieunhapkhoModel();
        $arySelect = [
            'pnk_chitiet.vukhi_id',
            'pnk_chitiet.nuocsanxuat_id',
            'pnk_chitiet.donvitinh_id',
            'pnk_chitiet.phancap_id',
            'phieunhapkho.lydonhapkho_id',
            DB::raw(" sum(pnk_chitiet.soluong_thucnhap) as  soluong_thucnhap ")
        ];
        if ($this->donvi_id > 0) {
            $allPXK = $tModel->where('phieunhapkho.donvi_id', $this->donvi_id);
        } else {
            $allPXK = $tModel->where('phieunhapkho.pnk_type', '=', 0);
        }
        $allPXK->leftJoin('pnk_chitiet', 'phieunhapkho.pnk_id', '=', 'pnk_chitiet.pnk_id');
        $allPXK->groupBy('pnk_chitiet.vukhi_id')->groupBy('pnk_chitiet.nuocsanxuat_id')->groupBy('pnk_chitiet.donvitinh_id')->groupBy('pnk_chitiet.phancap_id')->groupBy('phieunhapkho.lydonhapkho_id');
        $allPXK->where('phieunhapkho.pnk_ngay_thuchien', (($contain_date_from) ? '>=' : '>'), $date_from);
        $allPXK->where('phieunhapkho.pnk_ngay_thuchien', (($contain_date_to) ? '<=' : '<'), $date_to);
        $allPXK->where('phieunhapkho.pnk_status', '>', 0);
        $allPXK->select($arySelect);
        $temp = $allPXK->get();
        $aryData = [];
        if (!empty($temp)) {
            $temp = $temp->toArray();
            foreach ($temp as $v) {
                $aryData[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']][$v['lydonhapkho_id']] = $v;
            }
        }

//        pd($aryData['1010101']);
        return $aryData;
    }

    public function output($aryData, $view_name, $file_name)
    {
        if (request('export', '0') == 0) {
            return view($view_name, $aryData);
        } else {
            if (request('export_excel', '0') == 1) {
                $headres = array(
                    'Content-Type' => 'application/vnd.ms-excel',
                    'Content-Disposition' => 'attachment;Filename=' . $file_name . '_' . date('dMy_H\hi') . '.xls'
                );

            } else {
                $headres = array(
                    'Content-Type' => 'application/vnd.ms-word',
                    'Content-Disposition' => 'attachment;Filename=' . $file_name . '_' . date('dMy_H\hi') . '.doc'
                );
            }
            return \Response::view($view_name, $aryData, '200', $headres);
        }
    }
}