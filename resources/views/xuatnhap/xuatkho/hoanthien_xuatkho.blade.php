@extends('../master')
@section('content')
    <form action="" method="post">
        {{csrf_field()}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success"><span
                                class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message_success') !!}</em>
                    </div>
                @endif
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger"><span
                                class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message_error') !!}</em>
                    </div>
                @endif
                @if($errors->has())
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        @foreach ($errors->all() as $error)
                            <p><i class="glyphicon glyphicon-ok"></i>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h3 style="text-align:center;text-transform: uppercase">Hoàn thiện lệnh xuất kho</h3>

                    <div class="x_panel">
                        <div class="row body">
                            @if($allow_confirm)
                                <p class="text-center">
                                    <button class="btn btn-primary" type="submit">Hoàn thiện</button>
                                    <button class="btn btn-warning" type="reset">Thực hiện lại</button>
                                    <button class="btn btn-success" type="button"
                                            onclick="location.href='{{route('xuatnhap.dsxuatkho')}}'">Quay lại danh
                                        sách phiếu xuất kho
                                    </button>
                                    <br/>
                                    <br/>
                                    Ngày hoàn thiện:
                                    <input type="text" class="datetime"
                                           value="@if(!empty($phieuXuatKho->pxk_ngay_thuchien) && $phieuXuatKho->pxk_ngay_thuchien!='0000-00-00'){{date('m/d/Y', strtotime($phieuXuatKho->pxk_ngay_thuchien))}}@endif"
                                           name="pxk_ngay_thuchien">
                                </p>
                            @else
                                <p class="alert alert-warning">
                                    Phiếu xuất kho đã hoàn thiện
                                    ngày {{date('d-m-Y', strtotime($phieuXuatKho->pxk_ngay_thuchien))}}
                                </p>
                                <p class="text-center">
                                    <button class="btn btn-success" type="button"
                                            onclick="location.href='{{route('xuatnhap.dsxuatkho')}}'">Quay lại danh
                                        sách phiếu xuất kho
                                    </button>
                                </p>
                            @endif
                        </div>
                        <div class="row body">
                            <div class="col-xs-12">
                                <table class="table-bordered" style="margin: auto">
                                    <tr>
                                        <th rowspan="2" width="5%" class="text-center">Số thứ tự</th>
                                        <th rowspan="2" style="font-size: 15px" class="text-center">Tên vật phẩm</th>
                                        <th rowspan="2" class="text-center">Đơn vị tính</th>
                                        <th colspan="2" class="text-center">Số phải xuất kho</th>
                                        <th colspan="2" class="text-center">Số thực xuất kho</th>
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
                                        @if($v->soluong_thucxuat > 0 || $v->soluong_kehoach > 0)
                                            <tr>
                                                <td class="text-center">{{++$stt}}</td>
                                                <td class="text-center">{{$v->Thuclucvukhichitiet->vukhi->vukhi_name}}</td>
                                                <td class="text-center">{{$v->Thuclucvukhichitiet->donViTinh->donvitinh_name}}</td>
                                                <td class="text-center">{{$v->Thuclucvukhichitiet->phancap_id}}</td>
                                                <td class="text-center">{{$v->soluong_kehoach}}</td>
                                                <td class="text-center">{{$v->Thuclucvukhichitiet->phancap_id}}</td>
                                                <td class="text-center">
                                                    @if($allow_confirm)
                                                        <input type="text"
                                                               style="border: 1px solid  #ccc; margin: 2px;padding: 2px; width: 70px;"
                                                               name="real_out_stock[{{$v->pxk_chitiet_id}}]"
                                                               @if($phieuXuatKho->pxk_status == 0)
                                                               value="{{$v->soluong_kehoach}}"
                                                               @else
                                                               value="{{$v->soluong_thucxuat}}"
                                                                @endif
                                                                >
                                                    @else
                                                        <span @if($v->soluong_thucxuat == 0) style="color: #ddd;" @endif>{{$v->soluong_thucxuat}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.datetime').daterangepicker({
                    singleDatePicker: true,
                    format: 'DD/MM/YYYY',
                    calender_style: "picker_4"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>
    </form>
@endsection