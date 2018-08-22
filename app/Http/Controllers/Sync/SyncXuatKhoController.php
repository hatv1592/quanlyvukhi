<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Model\DonviModel;
use App\Model\DonvitinhModel;
use App\Model\NuocsanxuatModel;
use App\Model\VukhiModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use Carbon\Carbon;
use DB;


class SyncXuatKhoController extends Controller
{

    public function index()
    {
        if (request()->isMethod('post')) {
            return $this->exportData();
        }

        $aryData['donVi'] = DonviModel::getArrayDonvi();

        return view('sync.xuatkho.index');
        //màn hình đồng bộ
    }


    public function exportData()
    {
        $pnk = $this->_getAllPhieuXuatKho();
        return \Excel::create('XuatKho_' . date('Y_m_d_H\hi'), function ($excel) use ($pnk) {
            $excel->sheet('SheetXuatKho_' . date('Y_m_d_H\hi'), function ($sheet) use ($pnk) {
                $sheet->fromArray($pnk);
            });
        })->export('xls');
    }

    private function _getAllPhieuXuatKho($donvi_id = 0)
    {

        $arySelect = [
            'cancuxuatkho.cancuxuatkho_code',
            'phieuxuatkho.pxk_sophieu',
            'thuclucvukhi_chitiet.phancap_id',
            'vukhi.vukhi_id',
            'nuocsanxuat.nuocsanxuat_id',
            'donvitinh.donvitinh_id',
            DB::raw(' sum(soluong_thucxuat) as soluong ')
        ];

        $input = $this->_getInput();

        $str_code = $input['from_date_db'] . $input['to_date_db'] . '_xuatkho';
        if ($donvi_id > 0) {

//            $arySelect = array_merge($arySelect, [
//
//            ]);

        } else {


        }

        $tModel = new PhieuxuatkhoModel();

        $q = $tModel->select($arySelect);

        $q->groupBy('cancuxuatkho.cancuxuatkho_code')->groupBy('thuclucvukhi_chitiet.nuocsanxuat_id')->groupBy('thuclucvukhi_chitiet.vukhi_id')->groupBy('thuclucvukhi_chitiet.donvitinh_id')->groupBy('thuclucvukhi_chitiet.phancap_id');

        $q->leftJoin('pxk_chitiet', 'pxk_chitiet.pxk_id', '=', 'phieuxuatkho.pxk_id');
        $q->leftJoin('thuclucvukhi_chitiet', 'thuclucvukhi_chitiet.thuclucvukhi_chitiet_id', '=', 'pxk_chitiet.thuclucvukhi_chitiet_id');

        $q->leftJoin('vukhi', 'vukhi.vukhi_id', '=', 'thuclucvukhi_chitiet.vukhi_id');
        $q->leftJoin('nuocsanxuat', 'nuocsanxuat.nuocsanxuat_id', '=', 'thuclucvukhi_chitiet.nuocsanxuat_id');
        $q->leftJoin('donvitinh', 'donvitinh.donvitinh_id', '=', 'thuclucvukhi_chitiet.donvitinh_id');
        $q->leftJoin('cancuxuatkho', 'phieuxuatkho.cancuxuatkho_id', '=', 'cancuxuatkho.cancuxuatkho_id');

//        $q->where('cancuxuatkho.cancuxuatkho_code', '03/NK-2016');

        $q->where('phieuxuatkho.pxk_type', 0);
        $q->where('phieuxuatkho.pxk_status', '>=', 1);

        if ($donvi_id > 0) {
            $q->where('phieuxuatkho.donvixuat_id', $donvi_id);
        } else {
            $q->where('phieuxuatkho.pxk_ngay_thuchien', '>=', $input['from_date_db']);
            $q->where('phieuxuatkho.pxk_ngay_thuchien', '<=', $input['to_date_db']);
        }

        $q->orderBy('cancuxuatkho.cancuxuatkho_code');
        $q->orderBy('thuclucvukhi_chitiet.vukhi_id');

        $aryDataPNK = $q->get();

        if (!empty($aryDataPNK)) {
            $aryDataPNK = $aryDataPNK->toArray();
        } else {
            $aryDataPNK = [];
        }
        foreach ($aryDataPNK as $k => &$v) {
            $v['code'] = sha1((($k * 10 - 3) * 87) . $k . join(',&*(^%', $v) . $str_code);
        }
        if ($donvi_id == 0) {
            $aryDataPNK[] = ['tu_ngay', $input['from_date_db'], 'den_ngay', $input['to_date_db']];
        }
        return $aryDataPNK;

    }


    public function report()
    {
        return view('sync.xuatkho.report');
        //màn hình đồng bộ
    }

    public function compare()
    {
        $_message_error = '';
        $aryData['donvi_id'] = request('donvi_id', 0);
        $aryData['_message_success'] = '';
        if (request()->isMethod('post')) {
            try {
                list($aryExcelData) = $this->doUploadExcel($aryData);
                $aryData['compared'] = $this->_doCompare($aryData, $aryExcelData);
            } catch (\Exception $e) {
                $_message_error = $e->getMessage();
            }
        }
        $aryData['donVi'] = DonviModel::getArrayDonvi();
        $aryData['vuKhi'] = VukhiModel::getArrayVuKhi();
        $aryData['nuocSanXuat'] = NuocsanxuatModel::getArrayNuocSanXuat();
        $aryData['donViTinh'] = DonvitinhModel::getArrayDonViTInh();
        request()->flash();
        return view('sync.xuatkho.compare', $aryData)->with('_message_error', $_message_error);

        //màn hình đồng bộ
    }

    private function _getInput()
    {
        $input = request('input', []);

        $date = Carbon::createFromFormat('d/m/Y', trim($input['from_date']));
        $input['from_date_db'] = $date->format('Y-m-d');

        $date = Carbon::createFromFormat('d/m/Y H:i:s', trim($input['to_date'] . ' 23:59:59'));
        $input['to_date_db'] = $date->format('Y-m-d');
        return $input;
    }

    private function doUploadExcel($aryData)
    {
        $donvi_id = $aryData['donvi_id'];
        if ($donvi_id == 0) {
            throw new \Exception('Hãy chọn đơn vị cần đồng bộ');
        }

        $input = $this->_getInput();

        $str_code = $input['from_date_db'] . $input['to_date_db'] . '_xuatkho';;

        $file = request()->file('fileXls');
        if (empty($file)) {
            throw new \Exception('Hãy chọn file Excel để so sánh');
        }
        $destinationPath = storage_path('tmpUploadSync/xuatkho/' . date('Y/m/d'));
        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
        }
        $aryReturn = /*$aryCanCuXuatKhoCode = */
            [];
        $destinationPath .= DIRECTORY_SEPARATOR . $fileName;

        \Excel::load($destinationPath, function ($reader) use (
            $donvi_id, &$aryReturn, /*&$aryCanCuXuatKhoCode,*/
            $str_code
        ) {
            $results = $reader->all()->toArray();
            foreach ($results as $k => $v) {
                if ($v['cancuxuatkho_code'] == 'tu_ngay' || $v['cancuxuatkho_code'] == '') {
                    continue;
                }
                $t = $v;
                unset($t['code']);
                if ($v['code'] != sha1((($k * 10 - 3) * 87) . $k . join(',&*(^%', $t) . $str_code)) {
                    $aryReturn = [];
                    throw new \Exception('File Excel đã bị sửa đổi tại dòng số ' . (1 + $k));
                }
                $t['donvi_id'] = $donvi_id;
                $aryReturn[] = $t;
//                $aryCanCuXuatKhoCode[$t['cancuxuatkho_code']] = $t['cancuxuatkho_code'];
            }
        });
//        pd($aryReturn);
//        pd($aryCanCuXuatKhoCode);
//        if (!empty($aryReturn)) {
//            SyncTonKhoModel::where('donvi_id', $donvi_id)->delete();
//            SyncTonKhoModel::insert($aryReturn);
//        }
        return [$aryReturn/*, $aryCanCuXuatKhoCode*/];
    }

    private function _doCompare($aryData, $aryExcelData)
    {
//        dp($aryExcelData);

        $pnkCapTren = $this->_getAllPhieuXuatKho($aryData['donvi_id']);
//        dp($pnkCapTren);
        $aryMerge = [];
        foreach ($aryExcelData as $v) {
            $merged = false;
            foreach ($pnkCapTren as $k => $vukhiInCapTren) {
                if ($vukhiInCapTren['cancuxuatkho_code'] == $v['cancuxuatkho_code'] && $vukhiInCapTren['vukhi_id'] == $v['vukhi_id'] && $vukhiInCapTren['nuocsanxuat_id'] == $v['nuocsanxuat_id'] && $vukhiInCapTren['phancap_id'] == $v['phancap_id']) {
                    $v['soluong_cap_tren'] = $vukhiInCapTren['soluong'];
                    $v['pxk_sophieu_cap_tren'] = $vukhiInCapTren['pxk_sophieu'];
                    $aryMerge[$v['cancuxuatkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
                    $merged = true;
                    unset($pnkCapTren[$k]);
                    break;
                }
            }

            if ($merged == false) {
                $v['soluong_cap_tren'] = 0;
                $v['class'] = 'bg-warning-1';
                $v['pxk_sophieu_cap_tren'] = 'Cấp trên không ra lệnh';
                $aryMerge[$v['cancuxuatkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
            }
        }
        foreach ($pnkCapTren as $v) {
            $v['soluong_cap_tren'] = $v['soluong'];
            $v['pxk_sophieu_cap_tren'] = $v['pxk_sophieu'];
            $v['soluong'] = 0;
            $v['class'] = 'bg-warning-2';
            $v['pxk_sophieu'] = 'Cấp dưới không thực hiện';
            $aryMerge[$v['cancuxuatkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
        }
//        pd($aryMerge);
//        dd($aryMerge);
        return $aryMerge;
    }
}
