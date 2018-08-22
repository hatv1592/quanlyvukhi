@extends('../master')

@section('extension.style')
    <link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="{{URL::asset('public/css/common.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script>
        @if(session('flash_message_success'))
            sweetAlert({
                    title: "{{ session('flash_message_success') }}",
                    type: 'success'
                });
        @endif
    </script>
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

            </div>
            <div class="x_content">

                {{--                <h3 style="text-align:center;text-transform: uppercase">{{$name}}</h3>--}}
                <div class="x_panel">
                    <div class="row body">
                        <div class="col-xs-12">
                            <div>
                                <h3 class="text-center">ĐỐI CHIẾU DỮ LIỆU NHẬP KHO</h3>

                                @if($_message_error)
                                    <div class="alert alert-danger"><span
                                                class="glyphicon glyphicon-ok"></span><em> {!! $_message_error !!}</em>
                                    </div>
                                @endif
                                @if(!empty($_message_success))
                                    <div class="alert alert-success"><span
                                                class="glyphicon glyphicon-ok"></span><em> {!! $_message_success !!}</em>
                                    </div>
                                @endif

                                <form action="" class="form-horizontal form-label-left" method="post" target=""
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">


                                        <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                               style="text-align:left;">Đơn vị xuất:</label>

                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="donvi_id"
                                                    class="select2_single form-control">
                                                <option selected
                                                        value="0">Toàn bộ các đơn vị
                                                </option>
                                                @if(isset($donVi))
                                                    @foreach ($donVi as $key => $eachDonVi)
                                                        <option @if($key == $donvi_id) selected @endif
                                                        value="{{$key}}">{{$eachDonVi}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                               style="text-align:left;">
                                            Chọn dữ liệu so sánh:
                                        </label>

                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4 col-xs-12 btn btn-warning">
                                                <?php echo Form::file('fileXls', $attributes = array('value' => 'Chọn dữ liệu so sánh'));?>
                                                {{--<button class="btn btn-warning" type="reset">Chọn dữ liệu so sánh</button>--}}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="from_date" class="control-label col-md-2 col-xs-12"
                                               style="text-align:left;">Từ ngày</label>

                                        <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                            <input
                                                    name="input[from_date]" type="text"
                                                    class="form-control date"
                                                    value="@if(old('input')['from_date']){{old('input')['from_date']}} @endif"
                                                    placeholder="">
                                        </div>
                                        <label for="to_date" class="control-label col-md-2 col-xs-12"
                                               style="text-align:left;">Đến ngày</label>

                                        <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                            <input
                                                    name="input[to_date]" type="text"
                                                    class="form-control date"
                                                    value="@if(old('input')['to_date']){{old('input')['to_date']}} @endif"
                                                    placeholder="">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button class="btn btn-success" type="submit">Đối chiếu</button>

                                    </div>
                                </form>
                            </div>
                            <hr>
                        </div>
                        <div class="col-xs-12">
                            @if(!empty($donVi[$donvi_id]) && !empty($compared))
                                <div class="x_panel">
                                    <div class="row body">
                                        <div class="col-xs-12">
                                            <h2 style="text-align: center;font-size: 18px">ĐỐI CHIẾU DỮ LIỆU NHẬP
                                                KHÓ</h2>

                                            <h3 style="text-align: center;font-size: 14px">Đơn vị đối
                                                chiếu:{{$donVi[$donvi_id]}}</h3>
                                            <table class="table table-bordered"
                                                   style="border: 2px #aaa solid; margin: auto">
                                                <tbody>
                                                <tr>
                                                    <th rowspan="2" width="5%" class="text-center">STT</th>
                                                    <th rowspan="2" class="text-center">Căn cứ nhập kho</th>
                                                    <th colspan="6" style="font-size: 15px" class="text-center">Dữ liệu
                                                        của cơ
                                                        quan
                                                    </th>
                                                    <th colspan="2" class="text-center">{{$donVi[$donvi_id]}} nhập</th>
                                                    <th rowspan="2" class="text-center">Chênh lệch</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Số lệnh</th>
                                                    <th class="text-center">Tên Trang bị</th>
                                                    <th class="text-center">NSX</th>
                                                    <th class="text-center">ĐVT</th>
                                                    <th class="text-center">CLL</th>
                                                    <th class="text-center">Số lượng đã nhập</th>
                                                    <th class="text-center">Số lệnh</th>
                                                    <th class="text-center">Số lượng đã nhập</th>
                                                </tr>
                                                </tbody>
                                                <tbody>
                                                <?php
                                                $stt = 0;
                                                ?>
                                                @foreach($compared as $cancunhapkho_code => $aryCanCuNhapKhoCode)
                                                    @foreach($aryCanCuNhapKhoCode as $vukhi_id => $vukhi)
                                                        <?php
                                                        $first_vukhi = 0;
                                                        ?>
                                                        @foreach($vukhi as $nuocsanxuat_id => $nuocsanxuat)
                                                            <?php
                                                            $first_nuocsanxuat = 0;
                                                            $total_soluong_cap_tren = 0;
                                                            $total_soluong = 0;
                                                            $count_record = 0;
                                                            ?>
                                                            @foreach($nuocsanxuat as $phancap_id => $value)
                                                                @if($value['soluong_cap_tren'] > 0 || $value['soluong'] > 0)
                                                                    <?php
                                                                    $count_record++;
                                                                    $first_vukhi++;
                                                                    $first_nuocsanxuat++;
                                                                    ?>
                                                                    <?php
                                                                    $delta = $value['soluong_cap_tren'] - $value['soluong'];
                                                                    ?>
                                                                    <tr class="@if($delta <> 0) bg-danger @else bg-success @endif {{empty($value['class'])?'':$value['class']}}">
                                                                        <td class="text-center">@if($first_vukhi == 1){{++$stt}}@endif</td>
                                                                        <td class="text-center">{{$cancunhapkho_code}}</td>
                                                                        <td class="text-center">{{$value['pnk_sophieu_cap_tren']}}</td>
                                                                        <td class="text-center">
                                                                            @if($first_vukhi == 1){{$vuKhi[$vukhi_id]}}@endif
                                                                        </td>
                                                                        <td class="text-center">@if($first_nuocsanxuat == 1){{$nuocSanXuat[$value['nuocsanxuat_id']]}}@endif</td>
                                                                        <td class="text-center">@if($first_nuocsanxuat == 1){{$donViTinh[$value['donvitinh_id']]}}@endif</td>
                                                                        <td class="text-right">{{$value['phancap_id']}}</td>
                                                                        <td class="text-right">{{$value['soluong_cap_tren']}}</td>
                                                                        <td class="text-center">{{$value['pnk_sophieu']}}</td>
                                                                        <td class="text-right">{{$value['soluong']}}</td>
                                                                        <td class="text-right"
                                                                            style="@if($delta < 0) font-size: 18px; font-weight: bold; @endif">{{(($delta > 0)?'+':'').$delta}}</td>
                                                                    </tr>
                                                                    <?php
                                                                    $total_soluong_cap_tren += $value['soluong_cap_tren'];
                                                                    $total_soluong += $value['soluong'];
                                                                    $total_delta = $total_soluong_cap_tren - $total_soluong;
                                                                    ?>
                                                                @endif
                                                            @endforeach
                                                            @if($count_record > 1)
                                                                <tr class="@if($total_delta != 0) bg-warning @else bg-success @endif"
                                                                    style="font-size: 16px;">
                                                                    <td class="text-center"></td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-right">+</td>
                                                                    <td class="text-right">{{$total_soluong_cap_tren}}</td>
                                                                    <td class="text-center"></td>
                                                                    <td class="text-right">{{$total_soluong}}</td>
                                                                    <td class="text-right"
                                                                        style="@if($total_delta < 0) font-size: 18px; font-weight: bold; @endif">{{(($total_delta > 0)?'+':'').$total_delta}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.date').daterangepicker({
                singleDatePicker: true,
                format: 'DD/MM/YYYY',
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
@endsection