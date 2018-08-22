<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Model\DonviModel;
use App\Model\DonvitinhModel;
use App\Model\NuocsanxuatModel;
use App\Model\VukhiModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use Carbon\Carbon;
use DB;


class SyncNhapKhoController extends Controller
{

    public function index()
    {
        if (request()->isMethod('post')) {
            return $this->exportData();
        }

        $aryData['donVi'] = DonviModel::getArrayDonvi();

        return view('sync.nhapkho.index');
        //màn hình đồng bộ
    }


    public function exportData()
    {
        $pnk = $this->_getAllPhieuNhapKho();
        return \Excel::create('NhapKho_' . date('Y_m_d_H\hi'), function ($excel) use ($pnk) {
            $excel->sheet('SheetNhapKho_' . date('Y_m_d_H\hi'), function ($sheet) use ($pnk) {
                $sheet->fromArray($pnk);
            });
        })->export('xls');
    }

    private function _getAllPhieuNhapKho($donvi_id = 0)
    {

        $arySelect = [
            'cancunhapkho.cancunhapkho_code',
            'phieunhapkho.pnk_sophieu',
            'pnk_chitiet.phancap_id',
            'vukhi.vukhi_id',
            'nuocsanxuat.nuocsanxuat_id',
            'donvitinh.donvitinh_id',
            DB::raw(' sum(soluong_thucnhap) as soluong ')
        ];

        $input = $this->_getInput();

        $str_code = $input['from_date_db'] . $input['to_date_db'] . '_nhapkho';
        if ($donvi_id > 0) {

//            $arySelect = array_merge($arySelect, [
//
//            ]);

        } else {


        }

        $tModel = new PhieunhapkhoModel();

        $q = $tModel->select($arySelect);

        $q->groupBy('cancunhapkho.cancunhapkho_code')->groupBy('pnk_chitiet.nuocsanxuat_id')->groupBy('pnk_chitiet.vukhi_id')->groupBy('pnk_chitiet.donvitinh_id')->groupBy('pnk_chitiet.phancap_id');

        $q->leftJoin('pnk_chitiet', 'pnk_chitiet.pnk_id', '=', 'phieunhapkho.pnk_id');

        $q->leftJoin('vukhi', 'vukhi.vukhi_id', '=', 'pnk_chitiet.vukhi_id');
        $q->leftJoin('nuocsanxuat', 'nuocsanxuat.nuocsanxuat_id', '=', 'pnk_chitiet.nuocsanxuat_id');
        $q->leftJoin('donvitinh', 'donvitinh.donvitinh_id', '=', 'pnk_chitiet.donvitinh_id');
        $q->leftJoin('cancunhapkho', 'phieunhapkho.cancunhapkho_id', '=', 'cancunhapkho.cancunhapkho_id');

//        $q->where('cancunhapkho.cancunhapkho_code', '03/NK-2016');

        $q->where('phieunhapkho.pnk_type', 0);
        $q->where('phieunhapkho.pnk_status', '>=', 1);

        if ($donvi_id > 0) {
            $q->where('phieunhapkho.donvi_id', $donvi_id);
        } else {
            $q->where('phieunhapkho.pnk_ngay_thuchien', '>=', $input['from_date_db']);
            $q->where('phieunhapkho.pnk_ngay_thuchien', '<=', $input['to_date_db']);
        }

        $q->orderBy('cancunhapkho.cancunhapkho_code');
        $q->orderBy('pnk_chitiet.vukhi_id');

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
        return view('sync.nhapkho.report');
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
        return view('sync.nhapkho.compare', $aryData)->with('_message_error', $_message_error);

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

        $str_code = $input['from_date_db'] . $input['to_date_db'] . '_nhapkho';;

        $file = request()->file('fileXls');
        if (empty($file)) {
            throw new \Exception('Hãy chọn file Excel để so sánh');
        }
        $destinationPath = storage_path('tmpUploadSync/nhapkho/' . date('Y/m/d'));
        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
        }
        $aryReturn = /*$aryCanCuNhapKhoCode = */
            [];
        $destinationPath .= DIRECTORY_SEPARATOR . $fileName;

        \Excel::load($destinationPath, function ($reader) use (
            $donvi_id, &$aryReturn, /*&$aryCanCuNhapKhoCode,*/
            $str_code
        ) {
            $results = $reader->all()->toArray();
            foreach ($results as $k => $v) {
                if ($v['cancunhapkho_code'] == 'tu_ngay' || $v['cancunhapkho_code'] == '') {
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
//                $aryCanCuNhapKhoCode[$t['cancunhapkho_code']] = $t['cancunhapkho_code'];
            }
        });
//        pd($aryReturn);
//        pd($aryCanCuNhapKhoCode);
//        if (!empty($aryReturn)) {
//            SyncTonKhoModel::where('donvi_id', $donvi_id)->delete();
//            SyncTonKhoModel::insert($aryReturn);
//        }
        return [$aryReturn/*, $aryCanCuNhapKhoCode*/];
    }

    private function _doCompare($aryData, $aryExcelData)
    {
//        dp($aryExcelData);

        $pnkCapTren = $this->_getAllPhieuNhapKho($aryData['donvi_id']);
//        dp($pnkCapTren);
        $aryMerge = [];
        foreach ($aryExcelData as $v) {
            $merged = false;
            foreach ($pnkCapTren as $k => $vukhiInCapTren) {
                if ($vukhiInCapTren['cancunhapkho_code'] == $v['cancunhapkho_code'] && $vukhiInCapTren['vukhi_id'] == $v['vukhi_id'] && $vukhiInCapTren['nuocsanxuat_id'] == $v['nuocsanxuat_id'] && $vukhiInCapTren['phancap_id'] == $v['phancap_id']) {
                    $v['soluong_cap_tren'] = $vukhiInCapTren['soluong'];
                    $v['pnk_sophieu_cap_tren'] = $vukhiInCapTren['pnk_sophieu'];
                    $aryMerge[$v['cancunhapkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
                    $merged = true;
                    unset($pnkCapTren[$k]);
                    break;
                }
            }

            if ($merged == false) {
                $v['soluong_cap_tren'] = 0;
                $v['class'] = 'bg-warning-1';
                $v['pnk_sophieu_cap_tren'] = 'Cấp trên không ra lệnh';
                $aryMerge[$v['cancunhapkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
            }
        }
        foreach ($pnkCapTren as $v) {
            $v['soluong_cap_tren'] = $v['soluong'];
            $v['pnk_sophieu_cap_tren'] = $v['pnk_sophieu'];
            $v['soluong'] = 0;
            $v['class'] = 'bg-warning-2';
            $v['pnk_sophieu'] = 'Cấp dưới không thực hiện';
            $aryMerge[$v['cancunhapkho_code']][$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
        }
//        pd($aryMerge);
//        dd($aryMerge);
        return $aryMerge;
    }
}
