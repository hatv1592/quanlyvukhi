<?php


namespace App\Http\Controllers\Xuatnhap\Nhapkho;


use App\Http\Controllers\Controller;
use App\Http\Requests\PhieunhapkhoCompleteFormRequest;
use App\Http\Requests\PhieunhapkhoFormRequest;
use App\Model\ThuclucvukhichitietModel;
use App\Model\ThuclucvukhiModel;
use App\Model\Xuatnhap\PhieunhapkhochitietModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use App\Repositories\CancunhapkhoRepository;
use App\Repositories\DonViRepository;
use App\Repositories\DonViTinhRepository;
use App\Repositories\HeVuKhiRepository;
use App\Repositories\LydonhapkhoRepository;
use App\Repositories\NhomVuKhiRepository;
use App\Repositories\NuocSanXuatRepository;
use App\Repositories\PhieunhapkhoRepository;
use App\Repositories\VuKhiRepository;
use App\Services\PhieunhapkhoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use DB;

class PhieunhapkhoController extends Controller
{
    /**
     * @var CancunhapkhoRepository
     */
    private $cancunhapkhoRepository;

    /**
     * @var LydonhapkhoRepository
     */
    private $lydonhapkhoRepository;

    /**
     * @var DonViRepository
     */
    private $donViRepository;

    /**
     * @var DonViTinhRepository
     */
    private $donViTinhRepository;

    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * @var NhomVuKhiRepository
     */
    private $nhomVuKhiRepository;

    /**
     * @var VuKhiRepository
     */
    private $vuKhiRepository;

    /**
     * @var NuocSanXuatRepository
     */
    private $nuocSanXuatRepository;

    /**
     * @var PhieunhapkhoRepository
     */
    private $phieunhapkhoRepository;

    /**
     * @var PhieunhapkhoService
     */
    private $phieunhapkhoService;

    /**
     * PhieunhapkhoController constructor.
     *
     * @param CancunhapkhoRepository $cancunhapkhoRepository
     * @param LydonhapkhoRepository $lydonhapkhoRepository
     * @param DonViRepository $donViRepository
     * @param DonViTinhRepository $donViTinhRepository
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param NhomVuKhiRepository $nhomVuKhiRepository
     * @param VuKhiRepository $vuKhiRepository
     * @param NuocSanXuatRepository $nuocSanXuatRepository
     * @param PhieunhapkhoRepository $phieunhapkhoRepository
     * @param PhieunhapkhoService $phieunhapkhoService
     */
    public function __construct(
        CancunhapkhoRepository $cancunhapkhoRepository,
        LydonhapkhoRepository $lydonhapkhoRepository,
        DonViRepository $donViRepository,
        DonViTinhRepository $donViTinhRepository,
        HeVuKhiRepository $heVuKhiRepository,
        NhomVuKhiRepository $nhomVuKhiRepository,
        VuKhiRepository $vuKhiRepository,
        NuocSanXuatRepository $nuocSanXuatRepository,
        PhieunhapkhoRepository $phieunhapkhoRepository,
        PhieunhapkhoService $phieunhapkhoService
    ) {
        $this->cancunhapkhoRepository = $cancunhapkhoRepository;
        $this->lydonhapkhoRepository = $lydonhapkhoRepository;
        $this->donViRepository = $donViRepository;
        $this->donViTinhRepository = $donViTinhRepository;
        $this->heVuKhiRepository = $heVuKhiRepository;
        $this->nhomVuKhiRepository = $nhomVuKhiRepository;
        $this->vuKhiRepository = $vuKhiRepository;
        $this->nuocSanXuatRepository = $nuocSanXuatRepository;
        $this->phieunhapkhoRepository = $phieunhapkhoRepository;

        $this->phieunhapkhoService = $phieunhapkhoService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allPhieunhapkho = $this->phieunhapkhoRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        return view('xuatnhap.nhapkho.phieunhapkho.index')
            ->with([
                'allPhieunhapkho' => $allPhieunhapkho
            ]);
    }

    /**
     * Form add
     *
     * @param Request $request
     *
     * @return string
     */
    public function form(Request $request)
    {
        $cancunhapkho = $this->cancunhapkhoRepository->findAllActive();
        $lydonhapkho = $this->lydonhapkhoRepository->findAll();
        $donvinhap = $this->donViRepository->findAllChild();
        $hevukhi = $this->heVuKhiRepository->findAll();
        $donvitinh = $this->donViTinhRepository->findAll();
        $nhomvukhi = $this->nhomVuKhiRepository->findAll();

        $temp = [];
        $storeKey = $request->get('nhapkho_key_temp');

        if ($storeKey !== null) {
            $temp = $request->session()->get($storeKey);
        }

        return view('xuatnhap.nhapkho.phieunhapkho.add')
            ->with([
                'cancunhapkho' => ['' => 'Chọn'] + $cancunhapkho->pluck('cancunhapkho_name', 'cancunhapkho_id')->toArray(),
                'lydonhapkho' => ['' => 'Chọn'] + $lydonhapkho->pluck('lydonhapkho_name', 'lydonhapkho_id')->toArray(),
                'donvinhap' => ['' => 'Chọn'] + $donvinhap->pluck('donvi_name', 'donvi_id')->toArray(),
                'hevukhi' => ['' => 'Chọn'] + $hevukhi->pluck('hevukhi_name', 'hevukhi_id')->toArray(),
                'donvitinh' => ['' => 'Chọn'] + $donvitinh->pluck('donvitinh_name', 'donvitinh_id')->toArray(),
                'nhomvukhi' => ['' => 'Chọn'] + $nhomvukhi->pluck('nhomvukhi_name', 'nhomvukhi_id')->toArray(),
                'phieunhapkho' => !empty($temp['phieunhapkho']) ? $temp['phieunhapkho'] : null,
                'thongtinVukhi' => !empty($temp['thongtinVukhi']) ? $temp['thongtinVukhi'] : [],
                'storeKey' => $storeKey ? $storeKey : null
            ]);
    }

    /**
     * Handle save
     *
     * @param PhieunhapkhoFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(PhieunhapkhoFormRequest $request)
    {
        $storeKey = $this->getStoreKey($request);
        $temp = $request->session()->get($storeKey);

        $temp['phieunhapkho'] = $this->getPhieunhapkho($request);
        $temp['thongtinVukhi'][] = $this->getVuKhi($request);

        //Set into session
        $request->session()->set($storeKey, $temp);

        return redirect()->route('xuatnhap.nhapkho.phieunhapkho.form', 'nhapkho_key_temp=' . $storeKey)
            ->with('nhapkho_message_success', 'Add thành công vũ khí vào phiếu nhập kho.');
    }

    /**
     * Update phieunhapkho
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $temp = $this->phieunhapkhoService->initDataFormUpdate($id);

        $storeKey = $this->generateStoreKey();

        // Set into session
        request()->session()->set($storeKey, $temp);

        return redirect()->route('xuatnhap.nhapkho.phieunhapkho.form', 'nhapkho_key_temp=' . $storeKey);
    }

    /**
     * Completed
     *
     * @param PhieunhapkhoCompleteFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws InternalErrorException
     */
    public function complete(PhieunhapkhoCompleteFormRequest $request)
    {
        $storeKey = $storeKey = $request->get('nhapkho_key_temp');
        $temp = $request->session()->get($storeKey);

        $temp['phieunhapkho'] = $this->getPhieunhapkhoComplete($request);

        if (empty($temp['thongtinVukhi'])) {
            return redirect()->route('xuatnhap.nhapkho.phieunhapkho.form', 'nhapkho_key_temp=' . $storeKey)
                ->with('nhapkho_message_error', 'Chưa có vũ khí trong phiếu.');
        }

        try {
            if (!empty($temp['pnk_id'])) {
                $this->phieunhapkhoService->doUpdate($temp);
            } else {
                $this->phieunhapkhoService->doSave($temp);
            }

            $request->session()->forget($storeKey);

            $message = !empty($temp['pnk_id']) ? 'Cập nhật thành công phiếu nhập kho' : 'Tạo thành công phiếu nhập kho';

            return redirect()->route('xuatnhap.nhapkho.phieunhapkho.index')->with('add_phieunhapkho_success', $message);
        } catch (InternalErrorException $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * Delete vukhi in phieunhapkho
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws InternalErrorException
     */
    public function deleteVukhiInPhieunhapkho(Request $request, $id)
    {
        $storeKey = $request->get('nhapkho_key_temp');
        $tempData = $request->session()->get($storeKey);

        if (empty($tempData) || empty($tempData['thongtinVukhi'])) {
            throw new InternalErrorException("Data not found");
        }

        try {
            array_splice($tempData['thongtinVukhi'], $id, 1);
            $request->session()->set($storeKey, $tempData);

            return response()->json(null, 204);
        } catch (InternalErrorException $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * Delete a phieunhapkho by it's ID
     *
     * @param int $id
     *
     * @return mixed
     * @throws InternalErrorException
     */
    public function destroy($id)
    {
        try {
            $this->phieunhapkhoService->doDestroy($id);
            return response()->json([], 204);
        } catch (InternalErrorException $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * Generated the session store key
     *
     * @param PhieunhapkhoFormRequest $request
     * @return string
     */
    private function getStoreKey(PhieunhapkhoFormRequest $request)
    {
        if (null != $request->get('nhapkho_key_temp')) {
            $storeKey = $request->get('nhapkho_key_temp');
        } else {
            $storeKey = $this->generateStoreKey();
        }

        return $storeKey;
    }

    /**
     * Generate store key
     *
     * @return string
     */
    private function generateStoreKey()
    {
        return 'pnk-' . uniqid(12);
    }

    /**
     * Get info of phieunhapkho
     *
     * @param PhieunhapkhoFormRequest $request
     *
     * @return array
     */
    private function getPhieunhapkho(PhieunhapkhoFormRequest $request)
    {
        return [
            'cancunhapkho_id' => $request->input('cancunhapkho_id'),
            'donvi_id' => $request->input('donvinhap_id'),
            'lydonhapkho_id' => $request->input('lydonhapkho_id'),
            'donvixuat_name' => $request->input('donvixuat_name'),
            'pnk_ngay_hethan' => $request->input('pnk_ngay_hethan'),
            'pnk_donvivanchuyen' => $request->input('pnk_donvivanchuyen'),
            'pnk_nguoinhanhang' => $request->input('pnk_nguoinhanhang'),
            'pnk_phuongtienvanchuyen' => $request->input('pnk_phuongtienvanchuyen'),
            'pnk_nguoinhanphieu' => $request->input('pnk_nguoinhanphieu'),
            'pnk_nguoiralenh' => $request->input('pnk_nguoiralenh'),
            'pnk_type' => $request->input('pnk_type'),
        ];
    }

    /**
     * Get info of phieunhapkho complete
     *
     * @param PhieunhapkhoCompleteFormRequest $request
     *
     * @return array
     */
    private function getPhieunhapkhoComplete(PhieunhapkhoCompleteFormRequest $request)
    {
        return [
            'cancunhapkho_id'           => $request->input('cancunhapkho_id'),
            'donvi_id'                  => $request->input('donvinhap_id'),
            'lydonhapkho_id'            => $request->input('lydonhapkho_id'),
            'donvixuat_name'            => $request->input('donvixuat_name'),
            'pnk_ngay_hethan'           => $request->input('pnk_ngay_hethan'),
            'pnk_donvivanchuyen'        => $request->input('pnk_donvivanchuyen'),
            'pnk_nguoinhanhang'         => $request->input('pnk_nguoinhanhang'),
            'pnk_phuongtienvanchuyen'   => $request->input('pnk_phuongtienvanchuyen'),
            'pnk_nguoinhanphieu'        => $request->input('pnk_nguoinhanphieu'),
            'pnk_nguoiralenh'           => $request->input('pnk_nguoiralenh'),
            'pnk_type'                  => $request->input('pnk_type')
        ];
    }

    /**
     * Get info of vukhi
     *
     * @param PhieunhapkhoFormRequest $request
     *
     * @return array
     */
    private function getVuKhi(PhieunhapkhoFormRequest $request)
    {
        $vukhiInfo = [
            'hevukhi_id' => $request->input('hevukhi_id'),
            'nhomvukhi_id' => $request->input('nhomvukhi_id'),
            'covukhi_id' => $request->input('covukhi_id'),
            'vukhi_id' => $request->input('vukhi_id'),
            'nuocsanxuat_id' => $request->input('nuocsanxuat_id'),
            'donvitinh_id' => $request->input('donvitinh_id'),
            'phancap' => $request->input('phancap')
        ];

        if ($vukhiInfo['vukhi_id']) {
            $vukhiInfo['vukhi'] = $this->vuKhiRepository->findById($vukhiInfo['vukhi_id']);
        }

        if ($vukhiInfo['nuocsanxuat_id']) {
            $vukhiInfo['nuocsanxuat'] = $this->nuocSanXuatRepository->findById($vukhiInfo['nuocsanxuat_id']);
        }

        if ($vukhiInfo['donvitinh_id']) {
            $vukhiInfo['donvitinh'] = $this->donViTinhRepository->findById($vukhiInfo['donvitinh_id']);
        }

        return $vukhiInfo;
    }


    /**
     * Admin confirm phiếu nhập kho
     * @param $pnk_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function admin_confirm($pnk_id)
    {
        $phieuNhapKho = $this->phieunhapkhoService->getById($pnk_id);
        if ($phieuNhapKho->pnk_status == 0 || $phieuNhapKho->pnk_status == 1) {
            return $this->confirm($pnk_id, true);
        } elseif ($phieuNhapKho->pnk_status == 2) {
            throw new \Exception('Phiếu nhập kho đã được xác nhận');
        } else {
            throw new \Exception('Trạng thái phiếu nhập kho không xác định.');
        }
    }

    /**
     * confirm phieu nhap kho
     *
     * @param $pnk_id
     * @param bool $is_admin
     *
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function confirm($pnk_id, $is_admin = false)
    {

        $phieuNhapKho = $this->phieunhapkhoService->getById($pnk_id);
        if (empty($phieuNhapKho)) {
            return redirect(route('xuatnhap.nhapkho.phieunhapkho.index'))->with('message', 'Không tìm thấy phiếu nhập kho');
        }

        $allow_confirm = ($is_admin && $phieuNhapKho->pnk_status <= 1) ? 1 : ((!$is_admin && $phieuNhapKho->pnk_status == 0) ? 1 : 0);

        if (request()->isMethod('post') && $allow_confirm) {
            $this->_doConfirm($pnk_id, $phieuNhapKho, $is_admin);
            $phieuNhapKho = $this->phieunhapkhoService->getById($pnk_id);
            $allow_confirm = ($is_admin && $phieuNhapKho->pnk_status <= 1) ? 1 : ((!$is_admin && $phieuNhapKho->pnk_status == 0) ? 1 : 0);
        }


        $phieuNhapKhoChiTiet = PhieunhapkhochitietModel::where('pnk_id', $pnk_id)->get();
        return view('xuatnhap.nhapkho.phieunhapkho.hoanthien_nhapkho')
            ->with('phieuNhapKhoChiTiet', $phieuNhapKhoChiTiet)
            ->with('phieuNhapKho', $phieuNhapKho)
            ->with('allow_confirm', $allow_confirm)
            ->with('is_admin', (int)$is_admin);
    }

    private function _doConfirm($pnk_id, $phieuNhapKho, $is_admin = false)
    {
        $real_out_stock = request('real_out_stock', []);
        DB::transaction(function () use ($real_out_stock, $pnk_id, $phieuNhapKho, $is_admin) {
            $phieuNhapKho->pnk_status = ($is_admin) ? 2 : 1;
           
            if (request('pnk_ngay_thuchien', '')) {
                $date = Carbon::createFromFormat('d/m/Y', request('pnk_ngay_thuchien'));
                $phieuNhapKho->pnk_ngay_thuchien = $date->format('Y-m-d');
            }
            $phieuNhapKho->save();

            foreach ($real_out_stock as $pnk_chitiet_id => $soluong_thucnhap) {
                $phieuNhapKhoChiTiet = PhieunhapkhochitietModel::find($pnk_chitiet_id);
                $old_soluongthucnhap = $phieuNhapKhoChiTiet->soluong_thucnhap;
                $phieuNhapKhoChiTiet->soluong_thucnhap = $soluong_thucnhap;
                $phieuNhapKhoChiTiet->save();

                $delta = ($phieuNhapKhoChiTiet->soluong_thucnhap - $old_soluongthucnhap);
                /**
                 * Tìm, thêm vào bảng Thực Lực Vũ Khí
                 */
                $aryData = [
                    'nuocsanxuat_id' => $phieuNhapKhoChiTiet->nuocsanxuat_id,
                    'donvitinh_id' => $phieuNhapKhoChiTiet->donvitinh_id,
                    'vukhi_id' => $phieuNhapKhoChiTiet->vukhi_id,
                    'donvi_id' => $phieuNhapKho->donvi_id
                ];
                $aryDataFull = $aryData + [
                        'hevukhi_id' => $phieuNhapKhoChiTiet->vukhi->covukhi->nhomvukhi->hevukhi_id,
                        'nhomvukhi_id' => $phieuNhapKhoChiTiet->vukhi->covukhi->nhomvukhi_id,
                        'covukhi_id' => $phieuNhapKhoChiTiet->vukhi->covukhi_id,
                    ];
                $Thuclucvukhi = ThuclucvukhiModel::firstOrCreate($aryDataFull);
                $Thuclucvukhi->soluong = $Thuclucvukhi->soluong + $delta;
                $Thuclucvukhi->save();

                $aryDataFull['phancap_id'] = $phieuNhapKhoChiTiet->phancap_id;
                /**
                 * Tìm, thêm vào bảng Thực Lực Vũ Khí Chi Tiết
                 */
                $Thuclucvukhichitiet = ThuclucvukhichitietModel::firstOrCreate($aryDataFull);

                $Thuclucvukhichitiet->soluong = $Thuclucvukhichitiet->soluong + $delta;

                $Thuclucvukhichitiet->thuclucvukhi_id = $Thuclucvukhi->thuclucvukhi_id;

                $Thuclucvukhichitiet->donvitinh_id = $phieuNhapKhoChiTiet->donvitinh_id;
                $Thuclucvukhichitiet->save();

            }
        });
    }


    public function admin_delete($pnk_id, $is_admin = false)
    {
        $phieuNhapKho = PhieunhapkhoModel::find($pnk_id);
        if ($phieuNhapKho->pnk_status <= 1) {
            DB::transaction(function () use ($pnk_id, $is_admin, $phieuNhapKho) {
                if ($phieuNhapKho->pnk_status == 1) {
                    $phieuNhapKhoChiTiet = PhieunhapkhochitietModel::where('pnk_id', $pnk_id)->get();

                    foreach ($phieuNhapKhoChiTiet as $pnk_chitiet_id => $v) {
                        $soluong_thucnhap = $v->soluong_thucnhap;

                        if ($soluong_thucnhap > 0) {
                            $Thuclucvukhichitiet = ThuclucvukhichitietModel::where('nuocsanxuat_id', $v->nuocsanxuat_id)
                                ->where('vukhi_id', $v->vukhi_id)
                                ->where('donvi_id', $phieuNhapKho->donvi_id)
                                ->where('phancap_id', $v->phancap_id)
                                ->first();
                            $Thuclucvukhichitiet->soluong = $Thuclucvukhichitiet->soluong - $soluong_thucnhap;
                            $Thuclucvukhichitiet->save();
//                            echo $v->phancap_id.'--';
//                            echo $phieuNhapKho->donvi_id.'--';
//dd($v->vukhi_id);
                            $Thuclucvukhi = ThuclucvukhiModel::find($Thuclucvukhichitiet->thuclucvukhi_id);
                            $Thuclucvukhi->soluong = $Thuclucvukhi->soluong - $soluong_thucnhap;
                            $Thuclucvukhi->save();
                        }
                    }
                }
                PhieunhapkhochitietModel::where('pnk_id', $pnk_id)->delete();
                PhieunhapkhoModel::where('pnk_id', $pnk_id)->update(['pnk_status' => -1]);
            });
        } else {
            throw new \Exception("Không thể xóa phiếu này");
        }

        return redirect(route('xuatnhap.nhapkho.phieunhapkho.index'))->with('flash_message_success', 'Xóa thành công phiếu nhập kho');
    }

}