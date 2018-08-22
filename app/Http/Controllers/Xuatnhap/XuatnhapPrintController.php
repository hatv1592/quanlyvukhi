<?php

namespace App\Http\Controllers\Xuatnhap;

use App\Http\Controllers\Controller;

use App\Lib\SEO;
use App\Model\Xuatnhap\PhieunhapkhochitietModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use App\Model\Xuatnhap\PhieuxuatkhochitietModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use DB;
use Request;

class XuatnhapPrintController extends Controller
{

    public function printPhieuXuat($id)
    {
        (new SEO())->setHeader('Lenh Xuat Kho ' . date('d_M_Y_H_i'));

        $phieuXuatKho = PhieuxuatkhoModel::find($id);
        $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::where('pxk_id', $id)->get();
        return view('xuatnhap.print.xuatkho_print')
            ->with('phieuXuatKhoChiTiet', $phieuXuatKhoChiTiet)
            ->with('phieuXuatKho', $phieuXuatKho);
    }

    public function printPhieuNhap($id)
    {
        (new SEO())->setHeader('Lenh Nhap Kho ' . date('d_M_Y_H_i'));

        $phieuNhapKho = PhieunhapkhoModel::find($id);
        $phieuNhapKhoChiTiet = PhieunhapkhochitietModel::where('pnk_id', $id)->get();
        return view('xuatnhap.print.nhapkho_print')
            ->with('phieuNhapKhoChiTiet', $phieuNhapKhoChiTiet)
            ->with('phieuNhapKho', $phieuNhapKho);
    }
}
