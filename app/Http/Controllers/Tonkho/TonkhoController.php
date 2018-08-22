<?php

namespace App\Http\Controllers\Tonkho;

use App\Http\Controllers\Controller;

use App\Model\CovukhiModel;
use App\Model\DonviModel;
use App\Model\DonvitinhModel;
use App\Model\HevukhiModel;
use App\Model\NhomvukhiModel;
use App\Model\NuocsanxuatModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\ThuclucvukhiModel;
use App\Model\VukhiModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class TonkhoController extends Controller
{

    /**
     * Màn hình nhập tồn.
     *
     * @param array $donVi
     * @param array $heVuKhi
     * @param array $donViTinh
     * @param array $thucLucVuKhi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donvi_id = request('donvi_id', 0);

        $donVi = DonviModel::getArrayDonvi();
        $heVuKhi = HevukhiModel::getArrayHeVuKhi();
        $donViTinh = DonvitinhModel::getArrayDonvitinh();

        if ($donvi_id > 0) {
            $thucLucVuKhi = DB::table('thuclucvukhi')
                ->leftJoin('vukhi', 'thuclucvukhi.vukhi_id', '=', 'vukhi.vukhi_id')
                ->leftJoin('donvi', 'thuclucvukhi.donvi_id', '=', 'donvi.donvi_id')
                ->leftJoin('nuocsanxuat', 'thuclucvukhi.nuocsanxuat_id', '=', 'nuocsanxuat.nuocsanxuat_id')
                ->leftJoin('donvitinh', 'thuclucvukhi.donvitinh_id', '=', 'donvitinh.donvitinh_id')
                ->where('thuclucvukhi.donvi_id', $donvi_id)
                ->orderBy('thuclucvukhi_id', 'desc')
                ->select('*')
                ->paginate(10);
            $listThucLucVuKhiIds = $thucLucVuKhi->pluck('thuclucvukhi_id');
            $thucLucVuKhiChiTiet = DB::table('thuclucvukhi_chitiet')
                ->whereIn('thuclucvukhi_id', $listThucLucVuKhiIds)
                ->orderBy('thuclucvukhi_id', 'desc')
                ->select('*')
                ->get();
        } else {
            $thucLucVuKhi = [];
            $thucLucVuKhiChiTiet = [];
        }
        $soLuong = array();
        if (count($thucLucVuKhiChiTiet) > 0) {
            foreach ($thucLucVuKhiChiTiet as $key => $ct_val) {
                $soLuong[$ct_val->thuclucvukhi_id][$ct_val->phancap_id] = $ct_val->soluong;
                unset($thucLucVuKhiChiTiet[$key]);
            }
        }


        return view('tonkho.nhaptondau.index')
            ->with('aryCombobox', $this->_loadComboBoxData())
            ->with('donvi_id', $donvi_id)
            ->with('arrDonViTinh', $donViTinh)
            ->with('arrHeVuKhi', $heVuKhi)
            ->with('arrThucLucVuKhi', $thucLucVuKhi)
            ->with('arrDonVi', $donVi)
            ->with('arrSoLuong', $soLuong);
    }


    private function _loadComboBoxData()
    {
        $nhapTonDau = old('nhapTonDau');
        $aryCombobox = [];
        if (isset($nhapTonDau['hevukhi'])) {
            $aryCombobox['aryNhomVuKhi'] = NhomvukhiModel::where('hevukhi_id', $nhapTonDau['hevukhi'])->get();
            $aryCombobox['aryCoVuKhi'] = CovukhiModel::where('nhomvukhi_id', $nhapTonDau['nhomvukhi'])->get();
            $aryCombobox['aryVuKhi'] = VukhiModel::where('covukhi_id', $nhapTonDau['covukhi'])->get();
            $aryCombobox['aryNuocsanxuat'] = NuocsanxuatModel::where('hevukhi_id', $nhapTonDau['hevukhi'])->get();
        }
        return $aryCombobox;
    }

    /**
     * Hoàn thiện nhập tồn.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public
    function hoanthienNhapkho()
    {
        return view('pages.hoanthiennhapkho');
    }


    public
    function getNhomvukhi()
    {
        if (isset($_GET['hevukhi'])) {
            $hevukhi_id = $_GET['hevukhi'];
        }
        $list_nhom_vu_khi = array();
        $nhomvukhi = DB::table('nhomvukhi')
            ->select('*')
            ->where('hevukhi_id', $hevukhi_id)
            ->get();
        $html = '';
        if ($nhomvukhi) {
            $html = self::render_list_option($nhomvukhi, true);
        }
        return response()->json(['html' => $html, 'code' => 200]);
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
    public
    function getTableOption()
    {
        if (!isset($_GET['target_table_value'])) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu']);
        }
        if (!isset($_GET['target_table'])) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu']);
        }
        if (!isset($_GET['update'])) {
            return response()->json(['code' => 500, 'error' => 'Thiếu dữ liệu']);
        }
        $targetTableValue = $_GET['target_table_value'];
        $targetTable = $_GET['target_table'];
        $idResponse = $_GET['update'];
        $nhomVuKhi = DB::table($idResponse)
            ->select('*')
            ->where("$targetTable" . '_id', $targetTableValue)
            ->get();
        $html = '';
        if ($nhomVuKhi) {
            $html = self::render_list_option($idResponse, $nhomVuKhi, true);
        }
        if ($targetTable != 'hevukhi') {
            return response()->json(['html' => $html, 'code' => 200]);
        }
        $html_nsx = '';
        if ($targetTable == 'hevukhi') {
            $nuocSanXuat = DB::table('nuocsanxuat')
                ->select('*')
                ->where('hevukhi_id', $targetTableValue)
                ->get();
        }
        if ($nuocSanXuat) {
            $html_nsx = self::render_list_option('nuocsanxuat', $nuocSanXuat, true);
        }
        return response()->json(['html' => $html, 'html_nsx' => $html_nsx, 'code' => 200]);
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
    public
    static function render_list_option($tableName, $arrayResponse, $render = false)
    {
        $result = array();
        if (count($arrayResponse) <= 0) {
            return '<option value="">Chọn</option>';
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

    /**
     * Store Weapon
     *
     * @param  Request $request
     * @param  array $array_ket_qua
     * @param  boolean $render
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $nhapTonDau = $request->input('nhapTonDau');
            $validator = Validator::make($request->all(), ThuclucvukhiModel::rulesCreate('create'), ThuclucvukhiModel::message('create'));
            //Nếu sai
            $validator->setAttributeNames(ThuclucvukhiModel::setAttributeNames());
            if ($validator->fails()) {
                return redirect()->route('tonkho.index', ['donvi_id' => $nhapTonDau['donvi']])
                    ->withInput()->withErrors($validator);
            } else {
                if (ThuclucvukhiModel::checkExitsRecord($nhapTonDau)) {
                    return redirect()->route('tonkho.index', ['donvi_id' => $nhapTonDau['donvi']])
                        ->withInput()->with('flash_message_error', 'Dữ liệu đã tồn tại vui lòng nhập lại');
                }
                $thucLucVuKhi = new ThuclucvukhiModel();
                //Add value to hevukhi
                $thucLucVuKhi->hevukhi_id = $nhapTonDau['hevukhi'];
                $thucLucVuKhi->nhomvukhi_id = $nhapTonDau['nhomvukhi'];
                $thucLucVuKhi->covukhi_id = $nhapTonDau['covukhi'];
                $thucLucVuKhi->vukhi_id = $nhapTonDau['vukhi'];
                $thucLucVuKhi->nuocsanxuat_id = $nhapTonDau['nuocsanxuat'];
                $thucLucVuKhi->donvitinh_id = $nhapTonDau['donvitinh'];
                $thucLucVuKhi->donvi_id = $nhapTonDau['donvi'];
                $thucLucVuKhi->soluong = $nhapTonDau['cap1'] + $nhapTonDau['cap2'] + $nhapTonDau['cap3'] + $nhapTonDau['cap4'] + $nhapTonDau['cap5'];
                $thucLucVuKhi->save();
                for ($i = 1; $i < 6; $i++) {
                    $thucLucVuKhiChiTiet = new \App\Model\ThuclucvukhichitietModel();
                    //add value to hevukhi_chitiet
                    $thucLucVuKhiChiTiet->phancap_id = (int)$i;
                    $thucLucVuKhiChiTiet->thuclucvukhi_id = $thucLucVuKhi->thuclucvukhi_id;
                    $thucLucVuKhiChiTiet->soluong = $nhapTonDau['cap' . $i];
                    $thucLucVuKhiChiTiet->hevukhi_id = $nhapTonDau['hevukhi'];
                    $thucLucVuKhiChiTiet->nhomvukhi_id = $nhapTonDau['nhomvukhi'];
                    $thucLucVuKhiChiTiet->covukhi_id = $nhapTonDau['covukhi'];
                    $thucLucVuKhiChiTiet->vukhi_id = $nhapTonDau['vukhi'];
                    $thucLucVuKhiChiTiet->nuocsanxuat_id = $nhapTonDau['nuocsanxuat'];
                    $thucLucVuKhiChiTiet->donvitinh_id = $nhapTonDau['donvitinh'];
                    $thucLucVuKhiChiTiet->donvi_id = $nhapTonDau['donvi'];
                    $thucLucVuKhiChiTiet->save();
                }
                return redirect()->route('tonkho.index', ['donvi_id' => $nhapTonDau['donvi']])->with('flash_message_success', 'Thêm thành công')->withInput();
            }
        }
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
        $thucLucVuKhi = ThuclucvukhiModel::find($id);
        $thucLucVuKhiChiTiet = ThuclucvukhichitietModel::where('thuclucvukhi_id', $id)->get();
        if (!$thucLucVuKhi || !$thucLucVuKhiChiTiet) {
            return redirect()->route('tonkho.index')
                ->with('flash_message_error', 'Thực lực vũ khí không tồn tại');
        }
        //Array load sẵn
        $donVi = DonviModel::all();
        $heVuKhi = HevukhiModel::all();
        $donViTinh = DonvitinhModel::all();
        $nhomVuKhi = NhomvukhiModel::where('hevukhi_id', $thucLucVuKhi->hevukhi_id)->get();
        $coVukhi = CovukhiModel::where('nhomvukhi_id', $thucLucVuKhi->nhomvukhi_id)->get();
        $vuKhi = VukhiModel::where('covukhi_id', $thucLucVuKhi->covukhi_id)->get();
        $nuocSanXuat = NuocsanxuatModel::where('hevukhi_id', $thucLucVuKhi->hevukhi_id)->get();
        $soLuong = array();
        foreach ($thucLucVuKhiChiTiet as $ct_key => $ct_val) {
            $soLuong[$ct_val['phancap_id']] = $ct_val['soluong'];
        }
        return view('tonkho.nhaptondau.view')
            ->with('arrDonVi', $this->objectToOption($donVi, $thucLucVuKhi, 'donvi'))
            ->with('arrHeVuKhi', $this->objectToOption($heVuKhi, $thucLucVuKhi, 'hevukhi'))
            ->with('arrDonViTinh', $this->objectToOption($donViTinh, $thucLucVuKhi, 'donvitinh'))
            ->with('arrNhomVuKhi', $this->objectToOption($nhomVuKhi, $thucLucVuKhi, 'nhomvukhi'))
            ->with('arrCoVuKhi', $this->objectToOption($coVukhi, $thucLucVuKhi, 'covukhi'))
            ->with('arrVuKhi', $this->objectToOption($vuKhi, $thucLucVuKhi, 'vukhi'))
            ->with('arrNuocSanXuat', $this->objectToOption($nuocSanXuat, $thucLucVuKhi, 'nuocsanxuat'))
            ->with('thucLucVuKhi', $thucLucVuKhi)
            ->with('thucLucVuKhiChiTiet', $thucLucVuKhiChiTiet)
            ->with('soLuong', $soLuong);
    }

    /**
     * Chuyển từ giá trị model sang option
     * @param array $model
     * @return array $result
     */
    public
    function objectToOption($model, $thucLucVuKhi, $tableName)
    {
        $key = $tableName . '_id';
        $name = $tableName . '_name';
        $result = '<option value="">Chọn</option>';
        foreach ($model as $value) {
            $selected = ($thucLucVuKhi["$key"] == $value->$key) ? 'selected="selected"' : '';
            $result .= '<option ' . $selected . ' value="' . $value->$key . '">' . $value->$name . '</option>';
        }
        return $result;
    }

    /**
     * Update nhap ton dau thuc luc
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            $nhapTonDau = $request->input('nhapTonDau');
            $validator = Validator::make($request->all(), ThuclucvukhiModel::rulesCreate('update'), ThuclucvukhiModel::message('update'));
            //Nếu sai
            $validator->setAttributeNames(ThuclucvukhiModel::setAttributeNames());
            if ($validator->fails()) {
                return redirect()->route('tonkho.index', ['donvi_id' => $nhapTonDau['donvi']])
                    ->withInput()->withErrors($validator);
            } else {
                $thucLucVuKhi = ThuclucvukhiModel::find($id);
                //Add value to hevukhi
                $thucLucVuKhi->hevukhi_id = $nhapTonDau['hevukhi'];
                $thucLucVuKhi->nhomvukhi_id = $nhapTonDau['nhomvukhi'];
                $thucLucVuKhi->covukhi_id = $nhapTonDau['covukhi'];
                $thucLucVuKhi->vukhi_id = $nhapTonDau['vukhi'];
                $thucLucVuKhi->nuocsanxuat_id = $nhapTonDau['nuocsanxuat'];
                $thucLucVuKhi->donvitinh_id = $nhapTonDau['donvitinh'];
                $thucLucVuKhi->donvi_id = $nhapTonDau['donvi'];
                $thucLucVuKhi->soluong = $nhapTonDau['cap1'] + $nhapTonDau['cap2'] + $nhapTonDau['cap3'] + $nhapTonDau['cap4'] + $nhapTonDau['cap5'];
                $thucLucVuKhi->save();
                $thucLucVuKhiChiTietAll = ThuclucvukhichitietModel::where('thuclucvukhi_id', $id)
                    ->orderBy('phancap_id', 'ASC')
                    ->orderBy('donvi_id', $nhapTonDau['donvi'])
                    ->get();
                foreach ($thucLucVuKhiChiTietAll as $key => $thucLucVuKhiChiTiet) {
                    //add value to hevukhi_chitiet
                    $thucLucVuKhiChiTiet->hevukhi_id = $nhapTonDau['hevukhi'];
                    $thucLucVuKhiChiTiet->nhomvukhi_id = $nhapTonDau['nhomvukhi'];
                    $thucLucVuKhiChiTiet->covukhi_id = $nhapTonDau['covukhi'];
                    $thucLucVuKhiChiTiet->vukhi_id = $nhapTonDau['vukhi'];
                    $thucLucVuKhiChiTiet->nuocsanxuat_id = $nhapTonDau['nuocsanxuat'];
                    $thucLucVuKhiChiTiet->donvitinh_id = $nhapTonDau['donvitinh'];
                    $thucLucVuKhiChiTiet->donvi_id = $nhapTonDau['donvi'];
                    $thucLucVuKhiChiTiet->soluong = $nhapTonDau['cap' . ($key + 1)];
                    $thucLucVuKhiChiTiet->save();
                }
                return redirect()->route('tonkho.index', ['donvi_id' => $nhapTonDau['donvi']])->with('flash_message_success', 'Sửa thành công bản ghi');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($thuclucvukhi_id)
    {
        $thucLucVuKhi = ThuclucvukhiModel::find($thuclucvukhi_id);
        $old_donvi_id = $thucLucVuKhi->donvi_id;
        DB::transaction(function () use ($thuclucvukhi_id, $thucLucVuKhi) {
            ThuclucvukhichitietModel::where('thuclucvukhi_id', '=', $thuclucvukhi_id)->delete();
            $thucLucVuKhi->delete();
        });
        return redirect()->route('tonkho.index', ['donvi_id' => $old_donvi_id])->with('flash_message_success', 'Xóa thành công bản ghi');
    }

}