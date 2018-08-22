<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Model\DonviModel;
use App\Model\DonvitinhModel;
use App\Model\HevukhiModel;
use App\Model\NuocsanxuatModel;
use App\Model\SyncTonKhoModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\ThuclucvukhiModel;
use App\Model\VukhiModel;
use DB;


class SyncTonKhoController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        if (request()->isMethod('post')) {
            return $this->exportData();
        }

        $aryData['donVi'] = DonviModel::getArrayDonvi();
        return view('sync.tondau.index', $aryData);
        //màn hình đồng bộ
    }

    public function report()
    {
        return view('sync.tondau.report');
        //màn hình đồng bộ
    }

    public function exportData()
    {
        $allThucLucVuKhi = $this->_getAllThucLucVuKhi();
        return \Excel::create('TonKho_' . date('Y_m_d_H\hi'), function ($excel) use ($allThucLucVuKhi) {
            $excel->sheet('Sheet1', function ($sheet) use ($allThucLucVuKhi) {
                $sheet->fromArray($allThucLucVuKhi);
            });
        })->export('xls');
    }

    private function _getAllThucLucVuKhi($donvi_id = 0)
    {
        $tModel = new ThuclucvukhichitietModel();
        $currentThucLuc = $tModel->select(
            [
                'thuclucvukhi_chitiet.phancap_id',
                'vukhi.vukhi_id',
                'nuocsanxuat.nuocsanxuat_id',
                'donvitinh.donvitinh_id',
                DB::raw(' sum(soluong) as soluong ')
            ]
        );
        $currentThucLuc->groupBy('thuclucvukhi_chitiet.nuocsanxuat_id')->groupBy('thuclucvukhi_chitiet.vukhi_id')->groupBy('thuclucvukhi_chitiet.donvitinh_id')->groupBy('thuclucvukhi_chitiet.phancap_id');

        $currentThucLuc->leftJoin('vukhi', 'vukhi.vukhi_id', '=', 'thuclucvukhi_chitiet.vukhi_id');
        $currentThucLuc->leftJoin('nuocsanxuat', 'nuocsanxuat.nuocsanxuat_id', '=', 'thuclucvukhi_chitiet.nuocsanxuat_id');
        $currentThucLuc->leftJoin('donvitinh', 'donvitinh.donvitinh_id', '=', 'thuclucvukhi_chitiet.donvitinh_id');

        if ($donvi_id > 0) {
            $currentThucLuc->where('thuclucvukhi_chitiet.donvi_id', $donvi_id);
        }

        $aryData['current'] = $currentThucLuc->get();
        if (!empty($aryData['current'])) {
            $aryData['current'] = $aryData['current']->toArray();
        } else {
            $aryData['current'] = [];
        }
        foreach ($aryData['current'] as $k => &$v) {
            $v['code'] = sha1((($k * 10 - 3) * 87) . $k . join(',&*(^%', $v));
        }
        return $aryData['current'];

    }

    public function compare()
    {
        $_message_error = '';
        $aryData['donvi_id'] = request('donvi_id', 0);
        $aryData['_message_success'] = '';
        if (request()->isMethod('post')) {
            try {
                if (request('do_sync', '')) {
                    $return = $this->_doSync($aryData);
                    if($return) {
                        $aryData['_message_success'] = 'Đồng bộ thành công';
                    }
                } else {
                    $aryExcelData = $this->doUploadAndPushToDB($aryData);
                    $aryData['compared'] = $this->_doCompare($aryData, $aryExcelData);
                }
            } catch (\Exception $e) {
                $_message_error = $e->getMessage();
            }
        }
        $aryData['donVi'] = DonviModel::getArrayDonvi();
        $aryData['vuKhi'] = VukhiModel::getArrayVuKhi();
        $aryData['nuocSanXuat'] = NuocsanxuatModel::getArrayNuocSanXuat();
        $aryData['donViTinh'] = DonvitinhModel::getArrayDonViTInh();


        return view('sync.tondau.compare', $aryData)->with('_message_error', $_message_error);
        //màn hình đồng bộ
    }


    private function doUploadAndPushToDB($aryData)
    {
        $donvi_id = $aryData['donvi_id'];
        if ($donvi_id == 0) {
            throw new \Exception('Hãy chọn đơn vị cần đồng bộ');
        }
        $file = request()->file('fileXls');
        if (empty($file)) {
            throw new \Exception('Hãy chọn file Excel để so sánh');
        }
        $destinationPath = storage_path('tmpUploadSync/tonkho/' . date('Y/m/d'));
        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
        }
        $aryReturn = [];
        $destinationPath .= DIRECTORY_SEPARATOR . $fileName;

        \Excel::load($destinationPath, function ($reader) use ($donvi_id, &$aryReturn) {
            $results = $reader->all()->toArray();
            foreach ($results as $k => $v) {
                $t = $v;
                unset($t['code']);
                if ($v['code'] != sha1((($k * 10 - 3) * 87) . $k . join(',&*(^%', $t))) {
                    $aryReturn = [];
                    throw new \Exception('File Excel đã bị sửa đổi tại dòng số ' . (1 + $k));
                }
                $t['donvi_id'] = $donvi_id;
                $aryReturn[] = $t;
            }
        });
        if (!empty($aryReturn)) {
            SyncTonKhoModel::where('donvi_id', $donvi_id)->delete();
            SyncTonKhoModel::insert($aryReturn);
        }
        return $aryReturn;
    }

    private function _doCompare($aryData, $aryExcelData)
    {
        $currentThucLuc = $this->_getAllThucLucVuKhi($aryData['donvi_id']);
        $aryMerge = [];
        foreach ($aryExcelData as $v) {
            $merged = false;
            foreach ($currentThucLuc as $k => $vukhiInStock) {
                if ($vukhiInStock['vukhi_id'] == $v['vukhi_id'] && $vukhiInStock['nuocsanxuat_id'] == $v['nuocsanxuat_id'] && $vukhiInStock['phancap_id'] == $v['phancap_id']) {
                    $v['instock'] = $vukhiInStock['soluong'];
                    $aryMerge[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
                    $merged = true;
                    unset($currentThucLuc[$k]);
                    break;
                }
            }
            if ($merged == false) {
                $v['instock'] = 0;
                $aryMerge[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
            }
        }
        foreach ($currentThucLuc as $v) {
            $v['instock'] = $v['soluong'];
            $v['soluong'] = 0;
            $aryMerge[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
        }
        return $aryMerge;
    }


    private function _doSync($aryData)
    {
        $donvi_id = $aryData['donvi_id'];
        $dataSync = $this->_getSyncTonKho($donvi_id);

        $dataSync = $this->_smoothArray($dataSync);
        DB::transaction(function () use ($donvi_id, $dataSync) {
            ThuclucvukhichitietModel::where('donvi_id', $donvi_id)->delete();
            ThuclucvukhiModel::where('donvi_id', $donvi_id)->delete();
            foreach ($dataSync as $vukhi_id => $vukhi) {
                foreach ($vukhi as $nuocsanxuat_id => $nuocsanxuat) {
                    $aryThucLucChiTiet = [];
                    $aryThucLuc = [];
                    foreach ($nuocsanxuat as $phancap) {
                        $aryThucLucChiTiet[] = $phancap;
                        if (empty($aryThucLuc)) {
                            $aryThucLuc = $phancap;
                            unset($aryThucLuc['phancap_id']);
                        } else {
                            $aryThucLuc['soluong'] += $phancap['soluong'];
                        }
                    }
//                    pr($aryThucLuc);
                    $idThucLuc = ThuclucvukhiModel::insertGetId($aryThucLuc);

                    foreach ($aryThucLucChiTiet as &$v) {
                        $v['thuclucvukhi_id'] = $idThucLuc;
                    }
//                    pr($aryThucLucChiTiet);
                    ThuclucvukhichitietModel::insert($aryThucLucChiTiet);
                }
            }
        });
        return true;
    }


    private function _smoothArray($data)
    {
        $aryReturn = [];
        foreach ($data as $v) {
            $aryReturn[$v['vukhi_id']][$v['nuocsanxuat_id']][$v['phancap_id']] = $v;
        }
        return $aryReturn;
    }

    private function _getSyncTonKho($donvi_id)
    {


        $tModel = new SyncTonKhoModel();
        $syncData = $tModel->select(
            [
                'sync_tonkho.donvi_id',
                'sync_tonkho.soluong',
                'sync_tonkho.phancap_id',
                'sync_tonkho.vukhi_id',
                'sync_tonkho.nuocsanxuat_id',
                'sync_tonkho.donvitinh_id',
                'covukhi.covukhi_id',
                'hevukhi.hevukhi_id',
                'nhomvukhi.nhomvukhi_id',
            ]
        );

        $syncData->leftJoin('vukhi', 'vukhi.vukhi_id', '=', 'sync_tonkho.vukhi_id');
        $syncData->leftJoin('covukhi', 'covukhi.covukhi_id', '=', 'vukhi.covukhi_id');
        $syncData->leftJoin('nhomvukhi', 'nhomvukhi.nhomvukhi_id', '=', 'covukhi.nhomvukhi_id');
        $syncData->leftJoin('hevukhi', 'hevukhi.hevukhi_id', '=', 'nhomvukhi.hevukhi_id');

        $syncData->where('sync_tonkho.donvi_id', $donvi_id);

        $syncData->orderBy('sync_tonkho.vukhi_id', 'ASC');
        $syncData->orderBy('sync_tonkho.nuocsanxuat_id', 'ASC');
        $syncData->orderBy('sync_tonkho.phancap_id', 'ASC');

        $data = $syncData->get();
        if (!empty($data)) {
            $data = $data->toArray();
        } else {
            $data = [];
        }
        return $data;

    }
}