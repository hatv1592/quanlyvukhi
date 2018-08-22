<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Lib\SEO;
use App\Model\DonviModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use App\Services\ReportService;
use DB;


class ReportTangGiamThucLucController extends Controller
{
    private $reportService = null;

    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->reportService->groupByReason = true;
    }

    public function index()
    {
        if (request('_token', '') != '') {
            return $this->show();
        }
        $donVi = DonviModel::getArrayDonvi();
        return view('report.default_form_report')
            ->with('donVi', $donVi)
            ->with('name', 'Báo cáo Tăng giảm thực lực súng pháo khí tài (Mẫu 23/08/QK-VK)')
            ->with('action', route('report.tanggiamthucluc'))
            ->with('phieu_xuat_kho', []);
    }

    public function show()
    {
        $aryData = [];
        try {
            $this->reportService->prepareReportInput($aryData);
            $aryData['title'] = 'Báo cáo Tăng giảm thực lực súng pháo khí tài (Mẫu 23/08/QK-VK)';

            SEO::$title = 'Báo cáo Tăng giảm thực lực súng pháo khí tài từ ' . $aryData['input']['from_date'] . ' đến ' . $aryData['input']['to_date'];

        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', $e->getMessage())->withInput();
        }
        $this->reportService->prepareDataOutput($aryData);

        return $this->reportService->output($aryData, 'report.report_tanggiam_thucluc_02', 'tanggiam_thucluc');

    }

}
