@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {!! Form::open([]) !!}

                <h3 style="text-align:center;text-transform: uppercase">Viết phiếu xuất kho<br/>
                    <label style="font-size: 13px;">( <input
                                @if((isset(old('phieuxuatkho')['pxk_type']) && old('phieuxuatkho')['pxk_type'] == 1)
                                 ||
                                  (isset($phieuXuat['pxk_type']) && $phieuXuat['pxk_type'] ==1)) checked
                                @endif type="checkbox" value="1" name="phieuxuatkho[pxk_type]"> Phiếu
                        chuyển kho )</label>
                </h3>

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
                    <div class="form-horizontal form-label-left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Đơn vị xuất</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="donvixuat" name="phieuxuatkho[donvixuat_id]"
                                        class="select2_single form-control"
                                        data-url="{{route('xuatnhap.phieuxuatkho.create')}}"
                                        tabindex="-1">
                                    @if(isset($donViXuat))
                                        @foreach ($donViXuat as $key => $eachDonViXuat)
                                            <option @if($key == $donViXuatId) selected @endif
                                            value="{{$key}}">{{$eachDonViXuat}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <label for="cancu" class="control-label col-md-2 col-xs-12" for="cancu"
                                   style="text-align:left;">Căn cứ vào</label>

                            <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                <select @if(count($heVuKhi) <=0) disabled @endif() id="cancu"
                                        name="phieuxuatkho[cancuxuatkho_id]"
                                        class="select2_single form-control"
                                        tabindex="-1">
                                    @foreach ($canCuXuatKho as $key => $eachCanCuXuatKho)
                                        <option
                                                @if(old('phieuxuatkho')['cancuxuatkho_id'] == $key) selected="selected"
                                                @elseif(isset($phieuXuat['cancuxuatkho_id']) && $phieuXuat['cancuxuatkho_id'] == $key) selected="selected"
                                                @endif  value="{{$key}}">{{$eachCanCuXuatKho}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">

                            <label for="donvinhap" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Đơn vị nhập</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_nguoinhan"
                                       name="phieuxuatkho[donvinhap_name]" type="text"
                                       value="@if(old('phieuxuatkho')['donvinhap_name']) {{old('phieuxuatkho')['donvinhap_name']}}
                                       @elseif($phieuXuat['donvinhap_name']) {{$phieuXuat['donvinhap_name'] }} @endif"
                                       class="form-control">
                            </div>


                            <label for="lydoxuatkho_id" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Về việc</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select @if(count($heVuKhi) <=0) disabled @endif() id="lydoxuat"
                                        name="phieuxuatkho[lydoxuatkho_id]"
                                        class="select2_single form-control" tabindex="-1">
                                    @foreach ($lyDoXuatKho as $key => $eachLyDoXuatKho)
                                        <option @if(old('phieuxuatkho')['lydoxuatkho_id'] == $key || (isset($phieuXuat['lydoxuatkho_id']) && $phieuXuat['lydoxuatkho_id'] == $key)) selected @endif
                                        value="{{$key}}" >{{$eachLyDoXuatKho}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pxk_ngayhethan" class="control-label col-md-2 col-xs-12" for="covukhi"
                                   style="text-align:left;">Ngày hết hạn</label>

                            <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_ngayhethan"
                                       name="phieuxuatkho[pxk_ngay_hethan]" type="text"
                                       class="form-control"
                                       value="@if(old('phieuxuatkho')['pxk_ngay_hethan']){{old('phieuxuatkho')['pxk_ngay_hethan']}}
                                       @elseif($phieuXuat['pxk_ngay_hethan']){{$phieuXuat['pxk_ngay_hethan']}} @endif"
                                       placeholder="">
                            </div>
                            <label for="pxk_donvivanchuyen" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Đơn vị vận chuyển</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_donvivanchuyen"
                                       name="phieuxuatkho[pxk_donvivanchuyen]" type="text"
                                       value="@if(old('phieuxuatkho')['pxk_donvivanchuyen']){{old('phieuxuatkho')['pxk_donvivanchuyen']}}
                                       @elseif($phieuXuat['pxk_donvivanchuyen']){{$phieuXuat['pxk_donvivanchuyen']}} @endif"
                                       class=" form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pxk_nguoinhan" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Người nhận hàng</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_nguoinhan"
                                       name="phieuxuatkho[pxk_nguoinhan]" type="text"
                                       value="@if(old('phieuxuatkho')['pxk_nguoinhan']){{old('phieuxuatkho')['pxk_nguoinhan']}}
                                       @elseif($phieuXuat['pxk_nguoinhan']){{$phieuXuat['pxk_nguoinhan']}} @endif"
                                       class="form-control">
                            </div>
                            <label for="pxk_phuongtienvanchuyen" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Phương tiện vận chuyển</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_phuongtienvanchuyen"
                                       name="phieuxuatkho[pxk_phuongtienvanchuyen]"
                                       value="@if(old('phieuxuatkho')['pxk_phuongtienvanchuyen']){{old('phieuxuatkho')['pxk_phuongtienvanchuyen']}}
                                       @elseif($phieuXuat['pxk_phuongtienvanchuyen']){{$phieuXuat['pxk_phuongtienvanchuyen']}} @endif"
                                       type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pxk_nguoinhanphieu" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Người nhận phiếu</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_nguoinhanphieu"
                                       name="phieuxuatkho[pxk_nguoinhanphieu]" type="text"
                                       value="@if(old('phieuxuatkho')['pxk_nguoinhanphieu']){{old('phieuxuatkho')['pxk_nguoinhanphieu']}}
                                       @elseif($phieuXuat['pxk_nguoinhanphieu']){{$phieuXuat['pxk_nguoinhanphieu']}} @endif"
                                       class="form-control">
                            </div>
                            <label for="pxk_nguoiralenh" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Thủ trưởng ra lệnh</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input @if(count($heVuKhi) <=0) disabled @endif() id="pxk_nguoiralenh"
                                       name="phieuxuatkho[pxk_nguoiralenh]" type="text"
                                       value="@if(old('phieuxuatkho')['pxk_nguoiralenh']){{old('phieuxuatkho')['pxk_nguoiralenh']}}
                                       @elseif($phieuXuat['pxk_nguoiralenh']){{$phieuXuat['pxk_nguoiralenh']}} @endif"
                                       class="form-control">
                            </div>
                        </div>
                        <hr>
                        @if(count($heVuKhi) <=0)
                            <div style="padding:0 10px;">
                                <span style="color:red">* Vui lòng chọn đơn vị xuất - Đơn vị chưa nhập tồn đầu thực lực</span>
                                <hr>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="hevukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Hệ
                                vũ khí</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select @if(count($heVuKhi) <=0) disabled @endif()
                                id="hevukhi" name="vukhi[hevukhi]" target-table="hevukhi"
                                        update="nhomvukhi" class="select2_single form-control qlvk" tabindex="-1">
                                    <?php foreach ($heVuKhi as $key => $eachHeVuKhi) { ?>
                                        <?php echo '<option value="' . $key . '"   >' . $eachHeVuKhi . '</option>' ?>
                                        <?php } ?>
                                </select>
                            </div>
                            <label for="nhomvukhi" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Nhóm vũ khí</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select disabled id="nhomvukhi" name="vukhi[nhomvukhi]"
                                        target-table="nhomvukhi"
                                        update="covukhi" class="select2_single form-control qlvk" tabindex="-1">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="covukhi" class="control-label col-md-2 col-xs-12" for="covukhi"
                                   style="text-align:left;">Cỡ vũ khí</label>

                            <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                <select disabled id="covukhi" name="vukhi[covukhi]" target-table="covukhi"
                                        update="vukhi" class="select2_single form-control qlvk" tabindex="-1">
                                </select>
                            </div>
                            <label for="vukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Vũ
                                khí</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select disabled id="vukhi" name="vukhi[vukhi]" target-table="vukhi"
                                        update="donvitinh" class="select2_single form-control qlvk" tabindex="-1">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="donvitinh" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Đơn vị tính</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select disabled id="donvitinh" name="vukhi[donvitinh]"
                                        class="select2_single form-control qlvk2 " tabindex="-1">
                                    @if(isset($donViTinh))
                                        <?php foreach ($donViTinh as $key => $eachDonViTinh) { ?>
                                        <?php echo '<option value="' . $key . '">' . $eachDonViTinh . '</option>' ?>
                                        <?php } ?>
                                    @endif
                                </select>
                            </div>
                            <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12"
                                   style="text-align:left;">Nước sản xuất</label>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select disabled id="nuocsanxuat" name="vukhi[nuocsanxuat]"
                                        class="select2_single form-control qlvk2 " tabindex="-1">
                                    <!--<option value="0" >Chọn</option>-->
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div style="width: 20%;float: left;padding-left: 5px;text-align: center;">
                                <label for="cap1" class="control-label"
                                       style="width: 30%; float: left;text-align: center">Cấp 1:</label>

                                <div style="width: 40%;float: left">
                                    <input id="cap1" name="xuatkho[cap1]" type="text" class="chatluong form-control"
                                           placeholder="0">
                                </div>
                                <div style="width: 30%;float: left;padding-left: 5px;text-align: left">
                                    <span id="cap_1" style="line-height: 30px;color: red" class="tonkho"></span>
                                </div>
                            </div>
                            <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                <label for="cap2" class="control-label"
                                       style="width: 30%; float: left;text-align: center">Cấp 2:</label>

                                <div style="width: 40%;float: left">
                                    <input id="cap2" name="xuatkho[cap2]" type="text" class="chatluong form-control"
                                           placeholder="0">
                                </div>
                                <div style="width: 30%;float: left;padding-left: 5px;text-align: left">
                                    <span id="cap_2" style="line-height: 30px;color: red" class="tonkho"></span>
                                </div>
                            </div>
                            <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                <label for="cap3" class="control-label"
                                       style="width: 30%; float: left;text-align: center">Cấp 3:</label>

                                <div style="width: 40%;float: left">
                                    <input id="cap3" name="xuatkho[cap3]" type="text" class="chatluong form-control"
                                           placeholder="0">
                                </div>
                                <div style="width: 30%;float: left;padding-left: 5px;text-align: left">
                                    <span id="cap_3" style="line-height: 30px;color: red" class="tonkho"></span>
                                </div>
                            </div>
                            <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                <label for="cap4" class="control-label"
                                       style="width: 30%; float: left;text-align: center">Cấp 4:</label>

                                <div style="width: 40%;float: left">
                                    <input id="cap4" name="xuatkho[cap4]" type="text" class="chatluong form-control"
                                           placeholder="0">
                                </div>
                                <div style="width: 30%;float: left;padding-left: 5px;text-align: left">
                                    <span id="cap_4" style="line-height: 30px;color: red" class="tonkho"></span>
                                </div>
                            </div>
                            <div style="width: 20%;float: left;border-left: 1px solid #ccc;border-right: 1px solid #ccc">
                                <label for="cap5" class="control-label"
                                       style="width: 30%; float: left;text-align: center">Cấp 5:</label>

                                <div style="width: 40%;float: left">
                                    <input id="cap5" name="xuatkho[cap5]" type="text" class="chatluong form-control"
                                           placeholder="0">
                                </div>
                                <div style="width: 30%;float: left;padding-left: 5px;text-align: left">
                                    <span id="cap_5" style="line-height: 30px;color: red;" class="tonkho"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Xuất kho', ['class' => 'btn btn-primary']) !!}
                                @if(!empty($items))
                                    <input type="submit" value="In/ Kết thúc tạo phiếu" name="finish"
                                           class="btn btn-success"/>
                                @endif
                                <a href="{{ route('xuatnhap.dsxuatkho') }}"
                                   class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_content">
                                <table class="table table-bordered" id="">
                                    <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                    <thead style="text-align: center">
                                    <tr>
                                        <th rowspan="1">STT</th>
                                        <th rowspan="1">Tên vũ khí</th>
                                        <th rowspan="1">NSX</th>
                                        <th rowspan="1">ĐVT</th>
                                        <th rowspan="1">Cấp chất lượng</th>
                                        <th colspan="1" style="border-bottom: none;">SỐ lượng</th>
                                        <th colspan="1" style="border-bottom: none;">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($items))
                                        <?php $n = 0;?>
                                        @foreach($phieuXuatKhoChiTiet as $eachPhieuXuatKhoChiTiet)
                                            <tr>
                                                <td style="text-align: center">{{++$n}}</td>
                                                <td class="text-left">{{$eachPhieuXuatKhoChiTiet->vukhi->vukhi_name}}</td>
                                                <td style="text-align: center">{{$eachPhieuXuatKhoChiTiet->nuocsanxuat->nuocsanxuat_name}}</td>
                                                <td style="text-align: center">{{$eachPhieuXuatKhoChiTiet->donvitinh->donvitinh_name}}</td>
                                                <td>{{$eachPhieuXuatKhoChiTiet->phancap_id}}</td>
                                                <td>{{$items[$eachPhieuXuatKhoChiTiet->thuclucvukhi_chitiet_id]}}</td>
                                                <td>
                                                    <a href="{{ route('xuatnhap.phieuxuatkho.remove_item',array('id' => $eachPhieuXuatKhoChiTiet->thuclucvukhi_chitiet_id, 'donViXuatId' => $donViXuatId))}}"
                                                       class="btn btn-xs btn-danger"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        //        JS
        $(document).ready(function () {
            $('#pxk_ngayhethan').daterangepicker({
                singleDatePicker: true,
                format: 'DD/MM/YYYY',
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
        //
        $(document).ready(function () {
            $('select.form-control.qlvk').on('change', function () {
                var target_table_value = $(this).val();
                var target_table = $(this).attr('target-table');
                var update = $(this).attr('update');
                console.log(target_table_value);
                console.log(target_table);
                console.log(update);
                if (target_table_value != null && typeof target_table_value !== typeof undefined && target_table != '' && typeof target_table !== typeof undefined && update != '' && typeof update !== typeof undefined) {
                    $.ajax({
                        url: '{{route('xuatnhap.gettableoption',$donViXuatId)}}',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            "target_table_value": target_table_value,
                            "target_table": target_table,
                            "update": update
                        },
                        beforeSend: function (xhr) {
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                $("#" + update).html(data.html);
                                $("#" + update).removeAttr("disabled");
                                if (target_table == 'hevukhi') {
                                    $("#nhomvukhi").select2("val", "");
                                    $("#covukhi").attr("disabled", true).select2("val", "");
                                    $("#vukhi").attr("disabled", true).select2("val", "");
                                    $("#donvitinh").attr("disabled", true);
                                    $("#nuocsanxuat").attr("disabled", true);
                                }
                                if (target_table == 'nhomvukhi') {
                                    $("#covukhi").select2("val", "");
                                    $("#vukhi").attr("disabled", true).select2("val", "");
                                    $("#donvitinh").attr("disabled", true);
                                    $("#nuocsanxuat").attr("disabled", true);
                                }
                                if (target_table == 'covukhi') {
                                    $("#vukhi").select2("val", "");
                                    $("#donvitinh").attr("disabled", true);
                                    $("#nuocsanxuat").attr("disabled", true);
                                }
                                if (target_table == 'vukhi') {
                                    $("#donvitinh").removeAttr("disabled").html(data.html_dvt).select2("val", "");
                                    $("#nuocsanxuat").removeAttr("disabled").html(data.html_nsx).select2("val", "");

                                }
                                $(".chatluong").html("");
                                $(".tonkho").html('')
                            }
                        }
                    });
                } else {

                }
            });

            $('select#donvixuat').on('change', function () {
                var target_table_value = $(this).val();
                location.href = $(this).attr('data-url') + '?donvixuat_id=' + target_table_value;
            });

            $('select.form-control.qlvk2').on('change', function () {
                var donvixuat_id = $("#donvixuat").val();
                var hevukhi_id = $("#hevukhi").val();
                var nhomvukhi_id = $("#nhomvukhi").val();
                var covukhi_id = $("#covukhi").val();
                var vukhi_id = $("#vukhi").val();
                var donvitinh_id = $("#donvitinh").val();
                var nuocsanxuat_id = $("#nuocsanxuat").val();
                if (hevukhi_id == null || nhomvukhi_id == null || covukhi_id == null || vukhi_id == null || donvitinh_id == null || nuocsanxuat_id == null || donvixuat_id == null) {
                    return false;
                } else {
                    $.ajax({
                        url: '{{ url("/xuatnhap/getthongsothucluc/")}}',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            "donvi_id": donvixuat_id,
                            "hevukhi_id": hevukhi_id,
                            "nhomvukhi_id": nhomvukhi_id,
                            "covukhi_id": covukhi_id,
                            "vukhi_id": vukhi_id,
                            "donvitinh_id": donvitinh_id,
                            "nuocsanxuat_id": nuocsanxuat_id,
                        },
                        beforeSend: function (xhr) {
                        },
                        success: function (data) {
                            if (data) {
                                $('#cap_1').text(data.cap_1);
                                $('#cap_2').text(data.cap_2);
                                $('#cap_3').text(data.cap_3);
                                $('#cap_4').text(data.cap_4);
                                $('#cap_5').text(data.cap_5);
                            } else {

                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
