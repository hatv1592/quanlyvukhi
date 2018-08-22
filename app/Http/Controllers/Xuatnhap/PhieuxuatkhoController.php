<?php

namespace App\Http\Controllers\Xuatnhap;

use App\Http\Controllers\Controller;

use App\Model\DonviModel;
use App\Model\DonvitinhModel;
use App\Model\HevukhiModel;
use App\Model\LydoxuatkhoModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\ThuclucvukhiModel;
use App\Model\Xuatnhap\Cancunhapkho;
use App\Model\Xuatnhap\CancuxuatkhoModel;
use App\Model\Xuatnhap\PhieuxuatkhochitietModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Response;
use Validator;
use DB;

class PhieuxuatkhoController extends Controller
{

    /**
     * Danh sách lệnh xuất kho
     * @return $this
     */
    public function index()
    {
        $phieu_xuat_kho = PhieuxuatkhoModel::where('pxk_status', '>=', 0)->orderBy('pxk_id', 'DESC')->paginate(10);
        return view('xuatnhap.xuatkho.list')
            ->with('phieu_xuat_kho', $phieu_xuat_kho);
    }


    /**
     * Màn hinh tạo lệnh xuất kho
     */
    public function create(Request $request)
    {
        $donViXuatId = request('donvixuat_id', 0);
        $temp = $phieuXuat = $phieuXuatKhoChiTiet = $donViTinh = null;
        $heVuKhi = [];
        $donViNhap = DonviModel::getArrayDonvi();
        $lyDoXuatKho = LydoxuatkhoModel::getArrayLyDoXuatKho();
        $canCuXuatKho = CancuxuatkhoModel::getArrayCanCuXuatKho();
        $donViXuat = DonviModel::getArrayDonvi();


        if ($donViXuatId > 0) {
            $temp = request()->session()->get('sss_' . $donViXuatId);
            if (!empty($temp['phieuxuatkho'])) {
                $phieuXuat = $temp['phieuxuatkho'];
                $list_key = (array_keys($temp['items']));
                $phieuXuatKhoChiTiet = ThuclucvukhichitietModel::find($list_key);
            }
            $heVuKhi = HevukhiModel::getHeVuKhiByDonViId($donViXuatId);
        }
        return view('xuatnhap.xuatkho.view')
//            ->with('aryCombobox', $this->_loadComboBoxData())
            ->with('donViTinh', $donViTinh)
            ->with('heVuKhi', $heVuKhi)
            ->with('donViNhap', $donViNhap)
            ->with('donViXuat', $donViXuat)
            ->with('canCuXuatKho', $canCuXuatKho)
            ->with('lyDoXuatKho', $lyDoXuatKho)
            ->with('phieuXuatKhoChiTiet', $phieuXuatKhoChiTiet)
            ->with('phieuXuat', $phieuXuat)
            ->with('items', $temp['items'])
            ->with('donViXuatId', $donViXuatId);
    }

    /**
     * Lưu vào DB lần đầu
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $params * Tất cả request
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieuXuatKho = request('phieuxuatkho', 0);        //Thông tin phiếu xuất kho
        $donViXuatId = $phieuXuatKho['donvixuat_id'];
        $vuKhi = request('vukhi', 0);        //Thông tin phiếu xuất kho
        $xuatKho = request('xuatkho', 0);        //Thông tin phiếu xuất kho
        if ($donViXuatId > 0) {
            $temp = request()->session()->get('sss_' . $donViXuatId);
        } else {
            return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)
                ->withInput()
                ->with('flash_message_error', 'Hãy chọn đơn vị thực hiện lệnh xuất kho');
        }
        if (!isset($_POST['finish'])) {
            $validator = Validator::make($request->all(), PhieuxuatkhoModel::rulesCreate('update'), PhieuxuatkhoModel::message('update'));
        } else {
            $validator = Validator::make($request->all(), PhieuxuatkhoModel::rulesCreateBasic('update'), PhieuxuatkhoModel::message('update'));
        }
        //Validate
        $validator->setAttributeNames(PhieuxuatkhoModel::setAttributeNames());
        if ($validator->fails()) {
            return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)
                ->withInput()->withErrors($validator);
        }
        if (!isset($_POST['finish'])) {
            //Thông tin phiếu xuất kho
            $temp['phieuxuatkho'] = $phieuXuatKho;
            //Vòng lặp các cấp chất lượng
            for ($i = 1; $i <= 5; $i++) {
                if ($xuatKho['cap' . $i] <= 0) {
                    continue;
                }
                $thucLucVuKhiChiTietModel = ThuclucvukhichitietModel
                    ::where('nhomvukhi_id', $vuKhi['nhomvukhi'])
                    ->where('donvi_id', $phieuXuatKho['donvixuat_id'])
                    ->where('vukhi_id', $vuKhi['vukhi'])
                    ->where('donvitinh_id', $vuKhi['donvitinh'])
                    ->where('nuocsanxuat_id', $vuKhi['nuocsanxuat'])
                    ->where('hevukhi_id', $vuKhi['hevukhi'])
                    ->where('covukhi_id', $vuKhi['covukhi'])
                    ->where('phancap_id', $i)
                    ->first();
                // Kiểm tra
                //Kiểm tra số lượng
                if (empty($thucLucVuKhiChiTietModel->soluong) || $thucLucVuKhiChiTietModel->soluong < $xuatKho['cap' . $i]) {
                    return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)->withInput()->with('flash_message_error', 'Số tồn không đủ để xuất');
                }

                //Nếu > thì lưu vào temp
                if ($xuatKho['cap' . $i] > 0) {
                    $temp['items'][$thucLucVuKhiChiTietModel->thuclucvukhi_chitiet_id] = $xuatKho['cap' . $i];
                }
            }
            //Set vào session
            request()->session()->set('sss_' . $donViXuatId, $temp);
            return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)->with('flash_message_success', 'Add thành công vũ khí vào phiếu. Bạn có thể kết thục hoặc chọn thêm vũ khí vào phiếu');

        } else {

            if (count($temp['items']) <= 0) {
                return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)->with('flash_message_error', 'Chưa có vũ khí trong phiếu');
            }
            DB::transaction(function () use ($temp, $phieuXuatKho, $donViXuatId) {
                $date = Carbon::createFromFormat('d/m/Y', trim($phieuXuatKho['pxk_ngay_hethan']));
                $model = new PhieuxuatkhoModel();
                $model->pxk_nguoi_tao = 'admin';
                $model->pxk_ngay_tao = date('Y-m-d');
                $model->pxk_ngay_hethan = $date->format('Y-m-d');
                $model->pxk_status = 0;//Chua xuat kho ngay
                $model->pxk_type = isset($phieuXuatKho['pxk_type']) ? $phieuXuatKho['pxk_type'] : 0;
                $model->cancuxuatkho_id = $phieuXuatKho['cancuxuatkho_id'];
                $model->lydoxuatkho_id = $phieuXuatKho['lydoxuatkho_id'];
                $model->donvixuat_id = $phieuXuatKho['donvixuat_id'];
                $model->donvinhap_name = trim($phieuXuatKho['donvinhap_name']);
                $model->pxk_nguoinhan = trim($phieuXuatKho['pxk_nguoinhan']);
                $model->pxk_nguoinhanphieu = $phieuXuatKho['pxk_nguoinhanphieu'];
                $model->pxk_nguoiralenh = $phieuXuatKho['pxk_nguoiralenh'];
                $model->pxk_donvivanchuyen = $phieuXuatKho['pxk_donvivanchuyen'];
                $model->pxk_phuongtienvanchuyen = $phieuXuatKho['pxk_phuongtienvanchuyen'];

                $short_name_donvi = DonviModel::find($donViXuatId)->donvi_short_name;
                $code_auto = (new XuatnhapLib())->getAutoCodeExport($short_name_donvi);

                $model->pxk_sophieu = $code_auto['sophieu'];
                $model->pxk_code = $code_auto['code'];
                if ($model->save()) {
                    foreach ($temp['items'] as $key => $value) {
                        $phieuXuatKhoChiTiet = new PhieuxuatkhochitietModel();
                        $phieuXuatKhoChiTiet->pxk_id = $model->pxk_id;
                        $phieuXuatKhoChiTiet->thuclucvukhi_chitiet_id = $key;
                        $phieuXuatKhoChiTiet->soluong_kehoach = $value;
                        $phieuXuatKhoChiTiet->save();
                    }
                }
            });
            request()->session()->forget('sss_' . $donViXuatId);

            return redirect()->route('xuatnhap.dsxuatkho')->with('flash_message_success', 'Tạo thành công phiếu xuất kho');
        }
    }


    /**
     * Lấy ra thông số thực lực vũ khí
     *
     * @return \Illuminate\Http\Response
     */
    public function thongSoThucLuc(Request $request)
    {
        $params = $request->all();

        $thucLucVuKhi = ThuclucvukhiModel
            ::where('donvi_id', $params['donvi_id'])
            ->where('nhomvukhi_id', $params['nhomvukhi_id'])
            ->where('vukhi_id', $params['vukhi_id'])
            ->where('donvitinh_id', $params['donvitinh_id'])
            ->where('nuocsanxuat_id', $params['nuocsanxuat_id'])
            ->where('hevukhi_id', $params['hevukhi_id'])
            ->where('covukhi_id', $params['covukhi_id'])
            ->first();
        // Nếu không tồn tại
        if (!$thucLucVuKhi) {
            return Response::json([], 500);
        }

        //Lấy ra thực lực chi tiết

        $thucLucVuKhiChiTiet = ThuclucvukhichitietModel::where('thuclucvukhi_id', $thucLucVuKhi->thuclucvukhi_id)->get();
        if (count($thucLucVuKhiChiTiet)) {
            foreach ($thucLucVuKhiChiTiet as $item) {
                $thucLucVuKhi->{'cap_' . $item->phancap_id} = $item->soluong;
            }
        }
        return Response::json($thucLucVuKhi, 200);
    }

    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $phieuXuatKho = PhieuxuatkhoModel::find($id);
        if (!$phieuXuatKho) {
            return redirect()->route('xuatnhap.dsxuatkho')->with('flash_message_error', 'Phiếu xuất kho không tồn tại');
        }
        $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::where('pxk_id', $id)->get();
        $canCuXuatKho = CancuxuatkhoModel::getArrayCanCuXuatKho();
        $heVuKhi = HevukhiModel::getArrayHeVuKhi();
        $donViTinh = DonvitinhModel::getArrayDonvitinh();
        $donViNhap = DonviModel::getArrayDonvi(1);
        $donViXuat = DonviModel::getArrayDonvi(2);
        $lyDoXuatKho = LydoxuatkhoModel::getArrayLyDoXuatKho();
        return view('xuatnhap.xuatkho.edit')
            ->with('donViTinh', $donViTinh)
            ->with('heVuKhi', $heVuKhi)
            ->with('donViNhap', $donViNhap)
            ->with('donViXuat', $donViXuat)
            ->with('canCuXuatKho', $canCuXuatKho)
            ->with('lyDoXuatKho', $lyDoXuatKho)
            ->with('phieuXuatKhoChiTiet', $phieuXuatKhoChiTiet)
            ->with('phieuXuatKho', $phieuXuatKho);
    }

    /**
     * Lưu lần 2
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $phieuXuatKho = $params['phieuxuatkho'];
        $old_phieuxuatkho = $params['old_phieuxuatkho'];
        $model = PhieuxuatkhoModel::find($id);
        if ($phieuXuatKho == $old_phieuxuatkho) {
            $model->pxk_nguoi_tao = 'admin';
            $model->pxk_ngay_tao = date('Y-m-d');
            $model->pxk_ngay_hethan = date('Y-m-d', strtotime($phieuXuatKho['pxk_ngay_hethan']));
            $model->pxk_status = -1;
            $model->cancuxuatkho_id = $phieuXuatKho['cancuxuatkho_id'];
            $model->lydoxuatkho_id = $phieuXuatKho['lydoxuatkho_id'];
            $model->donvixuat_id = $phieuXuatKho['donvixuat_id'];
            $model->donvinhap_id = $phieuXuatKho['donvinhap_id'];
            $model->pxk_nguoinhan = $phieuXuatKho['pxk_nguoinhan'];
            $model->pxk_nguoinhanphieu = $phieuXuatKho['pxk_nguoinhanphieu'];
            $model->pxk_nguoiralenh = $phieuXuatKho['pxk_nguoiralenh'];
            $model->pxk_donvivanchuyen = $phieuXuatKho['pxk_donvivanchuyen'];
            $model->pxk_phuongtienvanchuyen = $phieuXuatKho['pxk_phuongtienvanchuyen'];
            $model->pxk_sophieu = '';
            $model->pxk_code = '';
            $model->save();
        }
        $vuKhi = $params['vukhi'];
        $xuatKho = $params['nhapton'];
        if ($model) {
            for ($i = 1; $i < 6; $i++) {
                if ($xuatKho['cap' . $i] <= 0) {
                    continue;
                }
                $thucLucVuKhiChiTietModel = ThuclucvukhichitietModel::where('nhomvukhi_id', $vuKhi['nhomvukhi'])
                    ->where('donvi_id', $phieuXuatKho['donvixuat_id'])
                    ->where('vukhi_id', $vuKhi['vukhi'])
                    ->where('donvitinh_id', $vuKhi['donvitinh'])
                    ->where('nuocsanxuat_id', $vuKhi['nuocsanxuat'])
                    ->where('hevukhi_id', $vuKhi['hevukhi'])
                    ->where('covukhi_id', $vuKhi['covukhi'])
                    ->where('phancap_id', $i)
                    ->first();
                if (!$thucLucVuKhiChiTietModel) {
                    return redirect()->route('xuatnhap.phieuxuatkho.edit', $model->pxk_id)->with('flash_message_error', 'Vũ khí hiện không có trong tồn đầu thực lực');
                };
                if ($thucLucVuKhiChiTietModel->soluong < $xuatKho['cap' . $i]) {
                    $xuatKho['cap' . $i] = $thucLucVuKhiChiTietModel->soluong;
                }
            }
            for ($i = 1; $i < 6; $i++) {
                if ($xuatKho['cap' . $i] <= 0) {
                    continue;
                }
                $thucLucVuKhiChiTietModel = ThuclucvukhichitietModel::where('nhomvukhi_id', $vuKhi['nhomvukhi'])
                    ->where('donvi_id', $phieuXuatKho['donvixuat_id'])
                    ->where('vukhi_id', $vuKhi['vukhi'])
                    ->where('donvitinh_id', $vuKhi['donvitinh'])
                    ->where('nuocsanxuat_id', $vuKhi['nuocsanxuat'])
                    ->where('hevukhi_id', $vuKhi['hevukhi'])
                    ->where('covukhi_id', $vuKhi['covukhi'])
                    ->where('phancap_id', $i)
                    ->first();
                $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::firstOrNew(array('pxk_id' => $id, 'thuclucvukhi_chitiet_id' => $thucLucVuKhiChiTietModel->thuclucvukhi_chitiet_id));
                $phieuXuatKhoChiTiet->pxk_id = $id;
                $phieuXuatKhoChiTiet->thuclucvukhi_chitiet_id = $thucLucVuKhiChiTietModel->thuclucvukhi_chitiet_id;
                $phieuXuatKhoChiTiet->soluong_kehoach = $xuatKho['cap' . $i];
                $phieuXuatKhoChiTiet->save();
            }
            if (isset($params['finish'])) {

            }
            return redirect()->route('xuatnhap.phieuxuatkho.edit', $model->pxk_id)->with('flash_message_success', 'Thêm thành công');
        }
        return redirect()->route('xuatnhap.dsxuatkho', $model->pxk_id)->with('flash_message_error', 'Phiếu xuất kho không tồn tại');
    }

    /**
     * Xóa lệnh xuất kho
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        try {
            $model = PhieuxuatkhoModel::find($id);
            if ($model && $model->pxk_status == 0) {
                $model->delete();
                PhieuxuatkhoModel::where('pxk_id', $id)->delete();
                return redirect()->route('xuatnhap.dsxuatkho', $id)
                    ->with('flash_message_success', 'Xóa thành công!');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Xóa vũ khí trong lệnh xuất kho
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function remove_item($id)
    {
        $donViXuatId = request('donViXuatId', 0);
        $temp = request()->session()->get('sss_' . $donViXuatId, []);
        if (isset($temp['items'][$id])) {
            unset($temp['items'][$id]);
        }
        request()->session()->set('sss_' . $donViXuatId, $temp);
        return redirect()->route('xuatnhap.phieuxuatkho.create', 'donvixuat_id=' . $donViXuatId)->with('flash_message_success', 'Xóa thành công');
    }

    /**
     * Kết thúc lệnh xuất kho.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function finish($id)
    {
        //
    }

    /**
     * Lấy các thuộc tính Ajax trả về các option dạng html.
     *
     * @param  int $targetTableValue {{Tên trường}
     * @param  int $targetTable {{Giá trị trường}}
     * @param  int $update {{ID nơi gán giá trị}}
     * @param  int $nhomViKhi
     *
     * @return \Illuminate\Http\Response|Json
     */
    public function getTableOption($donViId)
    {
        $targetTableValue = request('target_table_value', null);
        $targetTable = request('target_table', null);
        $idResponse = request('update', null);
        if (!isset($donViId) || $donViId == 0) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu donvi_id']);
        }
        if ($targetTableValue == null) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu "target_table_value"']);
        }
        if ($targetTable == null) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu table']);
        }
        if ($idResponse == null) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu update']);
        }

        $html = '';
        $html_nsx = '';

        //He vu khi
        if ($targetTable == 'hevukhi') {
            //get nhom vu khi
            $nhomVuKhi = DB::table('nhomvukhi')
                ->join('thuclucvukhi', 'nhomvukhi.nhomvukhi_id', '=', 'thuclucvukhi.nhomvukhi_id')
                ->select('*')
                ->groupBy('nhomvukhi.nhomvukhi_id')
                ->where('thuclucvukhi.hevukhi_id', '=', $targetTableValue)
                ->where('thuclucvukhi.donvi_id', '=', $donViId)
                ->get();

            if ($nhomVuKhi) {
                $html = self::render_list_option($idResponse, $nhomVuKhi, true);
            }
            return response()->json(['html' => $html, 'html_nsx' => $html_nsx, 'code' => 200]);
        }

        //Nhom vu khi
        if ($targetTable == 'nhomvukhi') {
            //get nhom vu khi
            $coVuKhi = DB::table('covukhi')
                ->join('thuclucvukhi', 'covukhi.covukhi_id', '=', 'thuclucvukhi.covukhi_id')
                ->select('*')
                ->groupBy('covukhi.covukhi_id')
                ->where('covukhi.nhomvukhi_id', '=', $targetTableValue)
                ->where('thuclucvukhi.donvi_id', '=', $donViId)
                ->get();
            if ($coVuKhi) {
                $html = self::render_list_option($idResponse, $coVuKhi, true);
            }
            return response()->json(['html' => $html, 'html_nsx' => $html_nsx, 'code' => 200]);
        }

        //Co vu khi
        if ($targetTable == 'covukhi') {
            //get nhom vu khi
            $vuKhi = DB::table('vukhi')
                ->join('thuclucvukhi', 'vukhi.vukhi_id', '=', 'thuclucvukhi.vukhi_id')
                ->select('*')
                ->groupBy('vukhi.vukhi_id')
                ->where('vukhi.covukhi_id', '=', $targetTableValue)
                ->where('thuclucvukhi.donvi_id', '=', $donViId)
                ->get();
            if ($vuKhi) {
                $html = self::render_list_option($idResponse, $vuKhi, true);
            }
            return response()->json(['html' => $html, 'html_nsx' => $html_nsx, 'code' => 200]);
        }

        //Vu khi
        if ($targetTable == 'vukhi') {
            //get nhom vu khi
            $nuocSanXuat = DB::table('nuocsanxuat')
                ->join('thuclucvukhi', 'thuclucvukhi.nuocsanxuat_id', '=', 'nuocsanxuat.nuocsanxuat_id')
                ->select('*')
                ->groupBy('nuocsanxuat.nuocsanxuat_id')
                ->where('thuclucvukhi.vukhi_id', $targetTableValue)
                ->where('thuclucvukhi.donvi_id', '=', $donViId)
                ->get();
            if ($nuocSanXuat) {
                $html_nsx = self::render_list_option('nuocsanxuat', $nuocSanXuat, true);
            }

            //get nuoc san xuat
            $donViTinh = DB::table('donvitinh')
                ->join('thuclucvukhi', 'thuclucvukhi.donvitinh_id', '=', 'donvitinh.donvitinh_id')
                ->select('*')
                ->groupBy('donvitinh.donvitinh_id')
                ->where('thuclucvukhi.vukhi_id', $targetTableValue)
                ->where('thuclucvukhi.donvi_id', '=', $donViId)
                ->get();
            if ($donViTinh) {
                $html_dvt = self::render_list_option('donvitinh', $donViTinh, true);
            }
            return response()->json(['html' => $html, 'html_nsx' => $html_nsx, 'html_dvt' => $html_dvt, 'code' => 200]);
        }

    }

    /**
     * Render ra html trả về Ajax
     *
     * @param  string $table_name {{Tên bảng}
     * @param  array $array_ket_qua {{Giá trị trường}}
     * @param  boolean $render {{ID nơi gán giá trị}}
     *
     * @return \Illuminate\Http\Response|Json
     */
    public static function render_list_option($tableName, $arrayResponse, $render = false)
    {
        $result = array();
        if (count($arrayResponse) <= 0) {
            return $result;
        }
        if ($tableName == 'hevukhi') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->hevukhi_id => $value->hevukhi_name);
            }
        } elseif ($tableName == 'nhomvukhi') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->nhomvukhi_id => $value->nhomvukhi_name);
            }
        } elseif ($tableName == 'covukhi') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->covukhi_id => $value->covukhi_name);
            }
        } elseif ($tableName == 'vukhi') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->vukhi_id => $value->vukhi_name);
            }
        } elseif ($tableName == 'nuocsanxuat') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->nuocsanxuat_id => $value->nuocsanxuat_name);
            }
        } elseif ($tableName == 'donvitinh') {
            foreach ($arrayResponse as $key => $value) {
                $result += array($value->donvitinh_id => $value->donvitinh_name);
            }
        }
        if ($render == false) {
            return $result;
        } else {
            $html = '<option value="">Chọn</option>';
            foreach ($result as $id_nhom_vu_khi => $ten_nhom_vu_khi) {
                $html .= '<option value="' . $id_nhom_vu_khi . '">' . $ten_nhom_vu_khi . '</option>';
            };
            return $html;
        }
    }

//    private function _loadComboBoxData()
//    {
//        $xuatKho = old('xuatkho');
//        $vuKhi = old('vukhi');
//        $phieuXuatKho = old('phieuxuatkho');
//        $aryCombobox = [];
//        if (isset($vuKhi)) {
//            $aryCombobox['aryHeVuKhi'] = DB::table('hevukhi')
//                ->join('thuclucvukhi', 'covukhi.covukhi_id', '=', 'thuclucvukhi.covukhi_id')
//                ->select('*')
//                ->groupBy('covukhi.covukhi_id')
//                ->where('covukhi.nhomvukhi_id', '=', $targetTableValue)
//                ->where('thuclucvukhi.donvi_id', '=', $phieuXuatKho)
//                ->get();
//            $aryCombobox['aryNhomVuKhi'] = NhomvukhiModel::where('hevukhi_id', $nhapTonDau['hevukhi'])->get();
//            $aryCombobox['aryCoVuKhi'] = CovukhiModel::where('nhomvukhi_id', $nhapTonDau['nhomvukhi'])->get();
//            $aryCombobox['aryVuKhi'] = VukhiModel::where('covukhi_id', $nhapTonDau['covukhi'])->get();
//            $aryCombobox['aryNuocsanxuat'] = NuocsanxuatModel::where('hevukhi_id', $nhapTonDau['hevukhi'])->get();
//            $aryCombobox['aryDonViTinh'] = NuocsanxuatModel::where('hevukhi_id', $nhapTonDau['hevukhi'])->get();
//        }
//        return $aryCombobox;
//    }

    /**
     * Admin confirm phiếu xuất kho
     * @param $pxk_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function admin_confirm($pxk_id)
    {
        $phieuXuatKho = PhieuxuatkhoModel::find($pxk_id);
        if ($phieuXuatKho->pxk_status == 0 || $phieuXuatKho->pxk_status == 1) {
            return $this->confirm($pxk_id, true);
        } elseif ($phieuXuatKho->pxk_status == 2) {
            throw new \Exception('Phiếu xuất kho đã được xác nhận');
        } else {
            throw new \Exception('Trạng thái phiếu xuất kho không xác định.');
        }
    }

    public function confirm($pxk_id, $is_admin = false)
    {
        $phieuXuatKho = PhieuxuatkhoModel::find($pxk_id);
        if (empty($phieuXuatKho)) {
            return redirect(route('xuatnhap.dsxuatkho'))->with('message', 'Không tìm thấy phiếu xuất kho');
        }

        $allow_confirm = ($is_admin && $phieuXuatKho->pxk_status <= 1) ? 1 : ((!$is_admin && $phieuXuatKho->pxk_status == 0) ? 1 : 0);

        if (request()->isMethod('post') && $allow_confirm) {
            $this->_doConfirm($pxk_id, $phieuXuatKho, $is_admin);
            $phieuXuatKho = PhieuxuatkhoModel::find($pxk_id);
            $allow_confirm = ($is_admin && $phieuXuatKho->pxk_status <= 1) ? 1 : ((!$is_admin && $phieuXuatKho->pxk_status == 0) ? 1 : 0);
        }


        $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::where('pxk_id', $pxk_id)->get();
        return view('xuatnhap.xuatkho.hoanthien_xuatkho')
            ->with('phieuXuatKhoChiTiet', $phieuXuatKhoChiTiet)
            ->with('phieuXuatKho', $phieuXuatKho)
            ->with('allow_confirm', $allow_confirm)
            ->with('is_admin', (int)$is_admin);
    }

    private function _doConfirm($pxk_id, $phieuXuatKho, $is_admin = false)
    {
        $real_out_stock = request('real_out_stock', []);
        DB::transaction(function () use ($real_out_stock, $pxk_id, $phieuXuatKho, $is_admin) {
            $phieuXuatKho->pxk_status = ($is_admin) ? 2 : 1;
            if (request('pxk_ngay_thuchien', '')) {
                $date = Carbon::createFromFormat('d/m/Y', request('pxk_ngay_thuchien'));
                $phieuXuatKho->pxk_ngay_thuchien = $date->format('Y-m-d');
            }
            $phieuXuatKho->save();

            foreach ($real_out_stock as $pxk_chitiet_id => $soluong_thucxuat) {
                $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::find($pxk_chitiet_id);
                $old_soluongthucxuat = $phieuXuatKhoChiTiet->soluong_thucxuat;
                $phieuXuatKhoChiTiet->soluong_thucxuat = $soluong_thucxuat;
                $phieuXuatKhoChiTiet->save();

                $delta = ($phieuXuatKhoChiTiet->soluong_thucxuat - $old_soluongthucxuat);;
                $Thuclucvukhichitiet = ThuclucvukhichitietModel::find($phieuXuatKhoChiTiet->thuclucvukhi_chitiet_id);
                $Thuclucvukhichitiet->soluong = $Thuclucvukhichitiet->soluong - $delta;
                $Thuclucvukhichitiet->save();

                $Thuclucvukhi = ThuclucvukhiModel::find($Thuclucvukhichitiet->thuclucvukhi_id);
                $Thuclucvukhi->soluong = $Thuclucvukhi->soluong - $delta;
                $Thuclucvukhi->save();
            }
        });
    }

    public function admin_delete($pxk_id, $is_admin = false)
    {
        $phieuXuatKho = PhieuxuatkhoModel::find($pxk_id);
        if ($phieuXuatKho->pxk_status <= 1) {
            DB::transaction(function () use ($pxk_id, $is_admin, $phieuXuatKho) {
                if ($phieuXuatKho->pxk_status == 1) {
                    $phieuXuatKhoChiTiet = PhieuxuatkhochitietModel::where('pxk_id', $pxk_id)->get();

                    foreach ($phieuXuatKhoChiTiet as $pxk_chitiet_id => $v) {
                        $soluong_thucxuat = $v->soluong_thucxuat;
                        if ($soluong_thucxuat > 0) {
                            $Thuclucvukhichitiet = ThuclucvukhichitietModel::find($v->thuclucvukhi_chitiet_id);
                            $Thuclucvukhichitiet->soluong = $Thuclucvukhichitiet->soluong + $soluong_thucxuat;
                            $Thuclucvukhichitiet->save();

                            $Thuclucvukhi = ThuclucvukhiModel::find($Thuclucvukhichitiet->thuclucvukhi_id);
                            $Thuclucvukhi->soluong = $Thuclucvukhi->soluong + $soluong_thucxuat;
                            $Thuclucvukhi->save();
                        }
                    }
                }
                PhieuxuatkhochitietModel::where('pxk_id', $pxk_id)->delete();
                PhieuxuatkhoModel::where('pxk_id', $pxk_id)->update(['pxk_status' => -1]);
            });
        } else {
            throw new \Exception("Không thể xóa phiếu này");
        }

        return redirect(route('xuatnhap.dsxuatkho'))->with('flash_message_success', 'Xóa thành công phiếu xuất kho');
    }
}
