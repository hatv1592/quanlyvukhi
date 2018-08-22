@extends('../master_print')
@section('content')
    <button type="button" id="btn_print" onclick="printDiv('printableArea')">In Lệnh Xuất Kho</button>
    <script>
        function printDiv(divName) {
            document.getElementById('btn_print').style.display = 'none';
            window.print();
        }
    </script>
    <div class="container print">
        <div class="row header">
            <div class="col-xs-4">
                QUÂN ĐỘI NHÂN DÂN VIỆT NAM
                <hr class="line"/>
            </div>
            <div class="col-xs-4 col-xs-offset-4">
                <div class="bold">
                    Mẫu số: 37/08/QK-VK
                </div>
                <div class="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 title" style="position: relative;">
                <img src="/public/images/static_qr_code_without_logo.jpg"
                     style="    position: absolute;top: -10px; left: 66px;width: 82px;">
                LỆNH XUẤT KHO
            </div>
            <div class="col-xs-4 col-xs-offset-8 bold">
                Số: {{$phieuXuatKho->pxk_sophieu}}
            </div>
        </div>
        <div class="row top">
            <div class="col-xs-5">
                <p>
                    <span class="_label">Căn cứ vào:</span><span>{{$phieuXuatKho->Cancuxuatkho->cancuxuatkho_name}}</span>
                </p>

                <p><span class="_label">Về việc:</span><span>{{$phieuXuatKho->Lydoxuatkho->lydoxuatkho_name}}</span></p>

                <p>
                    <span class="_label">Có giá trị đến ngày:</span><span>{{date('d-m-Y', strtotime($phieuXuatKho->pxk_ngay_hethan))}}</span>
                </p>
            </div>
            <div class="col-xs-4 col-xs-offset-2">
                <p><span class="_label">Đơn vị xuất:</span><span>{{$phieuXuatKho->DonviXuat->donvi_name}}</span></p>

                <p><span class="_label">Đơn vị nhập:</span><span>{{$phieuXuatKho->donvinhap_name}}</span></p>

                <p><span class="_label">Đơn vị vận chuyển:</span><span>{{$phieuXuatKho->pxk_donvivanchuyen}}</span></p>

                <p>
                    <span class="_label">Phương tiện vận chuyển:</span><span>{{$phieuXuatKho->pxk_phuongtienvanchuyen}}</span>
                </p>
            </div>
        </div>
        <div class="row body">
            <div class="col-xs-12">
                <table class="table-bordered" style="border: 2px #aaa solid">
                    <tr>
                        <th rowspan="2" width="5%" class="text-center">Số thứ tự</th>
                        <th rowspan="2" style="font-size: 15px" class="text-center">Tên vật phẩm</th>
                        <th rowspan="2" class="text-center">Nước<br/>sản<br/>xuất</th>
                        <th rowspan="2" class="text-center">Đơn<br/>vị<br/>tính</th>
                        <th colspan="2" class="text-center">Số phải xuất</th>
                        <th colspan="2" class="text-center">Số thực xuất</th>
                        <th rowspan="2" class="text-center">Đơn<br/>giá</th>
                        <th rowspan="2" class="text-center">Thành<br/>tiền</th>
                    </tr>
                    <tr>
                        <th class="text-center">Phân cấp</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Phân cấp</th>
                        <th class="text-center">Số lượng</th>
                    </tr>
                    <tbody>
                    <?php $stt = 0; ?>
                    @foreach($phieuXuatKho->Phieuxuatkhochitiet as $v)
                        @if($v->soluong_kehoach != 0 || $v->soluong_thucxuat !=0)
                            <tr>
                                <td class="text-center">{{++$stt}}</td>
                                <td class="text-center">{{$v->Thuclucvukhichitiet->vukhi->vukhi_name}}</td>
                                <td class="text-center">{{$v->Thuclucvukhichitiet->nuocSanXuat->nuocsanxuat_name}}</td>
                                <td class="text-center">{{$v->Thuclucvukhichitiet->donViTinh->donvitinh_name}}</td>
                                <td class="text-center">{{$v->Thuclucvukhichitiet->phancap_id}}</td>
                                <td class="text-center">{{\App\Lib\FuncLib::numberFormat($v->soluong_kehoach)}}</td>
                                <td class="text-center">{{$v->Thuclucvukhichitiet->phancap_id}}</td>
                                <td class="text-center">{{\App\Lib\FuncLib::numberFormat($v->soluong_thucxuat)}}</td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
                            </tr>
                        @endif
                    @endforeach
                    <?php
                    $add_row = ($stt > 10) ? 1 : (11 - $stt);
                    ?>
                    @for($i =0; $i < $add_row; $i++)
                        <tr>
                            <td class="text-center">&nbsp;</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if ($phieuXuatKho->pxk_ngay_thuchien) {
            list($y_ngay_thuchien, $m_ngay_thuchien, $d_ngay_thuchien) = explode('-', $phieuXuatKho->pxk_ngay_thuchien);
        } else {
            list($y_ngay_thuchien, $m_ngay_thuchien, $d_ngay_thuchien) = explode('-', '0000-00-00');
        }
        ?>
        <div class="row bottom">
            <div class="row">
                <div class="col-xs-12">
                    <p><span class="">Tiếp theo tờ:</span><span></span></p>

                    <p><span class="">Tổng số khoản trong tờ phiếu này:</span><span></span></p>

                    <p><span class="">Thành tiền:</span><span></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <p><span class="_label">Đơn vị xuất:</span><span></span></p>
                </div>
                <div class="col-xs-5">
                    <p>
                        <span class="">Đã thực hiện xong ngày {{$d_ngay_thuchien}} tháng {{$m_ngay_thuchien}}
                            năm {{$y_ngay_thuchien}}  </span><span></span>
                    </p>
                </div>
                <div class="col-xs-4 text-right" style="">
                    <?php list($d, $m, $y) = explode('-', date('d-m-Y'));?>
                    <p><span class="">Ngày {{$d}} tháng {{$m}} năm {{$y}}</span> &nbsp; &nbsp;</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                </div>
                <div class="col-xs-3">
                    <p><span class="_label">Họ tên, cấp bậc người nhận</span><span></span></p>
                </div>
                <div class="col-xs-3 text-center">
                    <p><span class="_label">Người nhận phiếu</span><span></span></p>
                </div>
                <div class="col-xs-3 text-center">
                    <p><span class="_label">Thủ trưởng ra lệnh</span> &nbsp; &nbsp;</p>
                </div>
            </div>
            <div class="row" style="margin-top: 80px;">
                <div class="col-xs-3">
                </div>
                <div class="col-xs-3 text-center">
                    <p><span class="_label">{{$phieuXuatKho->pxk_nguoinhan}}</span><span></span></p>
                </div>
                <div class="col-xs-3 text-center">
                    <p><span class="_label">{{$phieuXuatKho->pxk_nguoinhanphieu}}</span><span></span></p>
                </div>
                <div class="col-xs-3 text-center">
                    <p><span class="_label">{{$phieuXuatKho->pxk_nguoiralenh}}</span> &nbsp; &nbsp;</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn_print').focus();
        });
    </script>
@endsection