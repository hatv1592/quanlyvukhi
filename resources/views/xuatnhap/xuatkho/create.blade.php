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
                <h3 style="text-align:center;text-transform: uppercase">Viết phiếu xuất kho</h3>
                <div class="x_panel">
                    <div>
                        <form onsubmit="return xuatkho_validate()" class="form-horizontal form-label-left" action=""
                              method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="cancu" class="control-label col-md-2 col-xs-12" for="cancu"
                                       style="text-align:left;">Căn cứ vào</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <select id="cancu" name="phieuxuatkho[cancu]" class="select2_single form-control"
                                            tabindex="-1">
                                        @foreach ($canCuXuatKho as $key => $eachCanCuXuatKho)
                                            <option value="{{$key}}">{{$eachCanCuXuatKho}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị xuất</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="donvixuat" name="phieuxuatkho[donvixuat]"
                                            class="select2_single form-control" tabindex="-1">
                                        @if(isset($donViXuat) && count($donViXuat)>0)
                                            @foreach ($donViXuat as $key => $eachDonViXuat)
                                                <option @if($key == $donViXuatId) selected @endif
                                                value="{{$key}}">{{$donVi}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lydoxuatkho_id" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Về việc</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="lydoxuat" name="phieuxuatkho[lydoxuatkho_id]"
                                            class="select2_single form-control" tabindex="-1">
                                        @foreach ($lyDoXuatKho as $key => $eachLyDoXuatKho)
                                            <option value="{{$key}}">{{$eachLyDoXuatKho}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="donvi_id" class="control-label col-md-2 col-xs-12" style="text-align:left;">Đơn
                                    vị nhận</label>
                                <div class="col-md-3 col-sm-3 col-xs-9">
                                    <select id="donvinhap" name="phieuxuatkho[donvinhap]"
                                            class="select2_single form-control" tabindex="-1">
                                        @foreach ($donViNhap as $key => $eachDonViNhap)
                                            <option value="{{$key}}">{{$eachDonViNhap}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-3">
                                    <a class="btn btn-md btn-info">
                                        Tạo
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pxk_ngayhethan" class="control-label col-md-2 col-xs-12" for="covukhi"
                                       style="text-align:left;">Ngày hết hạn</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_ngayhethan" name="phieuxuatkho[pxk_ngay_hethan]" type="text"
                                           class="form-control"
                                           placeholder="">
                                </div>
                                <label for="pxk_donvivanchuyen" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị vận chuyển</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_donvivanchuyen" name="phieuxuatkho[pxk_donvivanchuyen]" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pxk_nguoinhanhang" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Người nhận hàng</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_nguoinhanhang" name="phieuxuatkho[pxk_nguoinhanhang]" type="text"
                                           class="form-control">
                                </div>
                                <label for="pxk_phuongtienvanchuyen" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Phương tiện vận chuyển</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_phuongtienvanchuyen" name="phieuxuatkho[pxk_phuongtienvanchuyen]"
                                           type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pxk_nguoinhan" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Người nhận phiếu</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_nguoinhan" name="phieuxuatkho[pxk_nguoinhan]" type="text"
                                           class="form-control">
                                </div>
                                <label for="pxk_nguoiralenh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Thủ trưởng ra lệnh</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="pxk_nguoiralenh" name="phieuxuatkho[pxk_nguoiralenh]" type="text"
                                           class="form-control">
                                </div>
                            </div>
                            <hr>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Tạo phiếu xuất kho</button>
                                    <a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-">Quay lại</a>
                                </div>
                            </div>
                            <hr>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function xuatkho_validate() {
                if ($("#donvi").val() == null || $("#donvi").val() == '') {
                    alert('Vui lòng chọn đơn vị');
                    return false;
                } else if ($("#hevukhi").val() == null || $("#hevukhi").val() == '') {
                    alert('Vui lòng chọn hệ vũ khí');
                    return false;
                } else if ($("#nhomvukhi").val() == null || $("#nhomvukhi").val() == '') {
                    alert('Vui lòng chọn nhóm vũ khí');
                    return false;
                } else if ($("#covukhi").val() == null || $("#covukhi").val() == '') {
                    alert('Vui lòng chọn cỡ vũ khí');
                    return false;
                } else if ($("#vukhi").val() == null || $("#vukhi").val() == '') {
                    alert('Vui lòng chọn vũ khí');
                    return false;
                } else if ($("#donvitinh").val() == null || $("#donvitinh").val() == '') {
                    alert('Vui lòng chọn đơn vị tính');
                    return false;
                } else if ($("#nuocsanxuat").val() == null || $("#nuocsanxuat").val() == '') {
                    alert('Vui lòng chọn nước sản xuất');
                    return false;
                } else if ($("#cap1").val() == '' && $("#cap2").val() == '' && $("#cap3").val() == '' && $("#cap4").val() == '' && $("#cap5").val() == '') {
                    alert('Số vui lòng nhập số lượng vũ khí');
                    return false;
                } else {
                    return true;
                }
            }
            $(document).ready(function () {
                $('#pxk_ngayhethan').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
            $(document).ready(function () {
                $('select.form-control.qlvk').on('change', function () {
                    var target_table_value = $(this).val();
                    var target_table = $(this).attr('target-table');
                    var update = $(this).attr('update');
                    if (target_table_value != null && target_table_value != 'undefined' && target_table != 'undefined' && update != 'undefined') {
                        $.ajax({
                            url: '{{ url("/tonkho/gettableoption/")}}',
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
                                console.log(data);
                                if (data.code == 200) {
                                    $("#" + update).html(data.html);
                                    $("#" + update).removeAttr("disabled");
                                }
                                if (target_table == 'hevukhi') {
                                    $("#nuocsanxuat").removeAttr("disabled").html(data.html_nsx).select2("val", "");
                                    $("#nhomvukhi").select2("val", "");
                                    $("#covukhi").attr("disabled", true).select2("val", "");
                                    $("#vukhi").attr("disabled", true).select2("val", "");
                                }
                                if (target_table == 'nhomvukhi') {
                                    $("#covukhi").select2("val", "");
                                    $("#vukhi").attr("disabled", true).select2("val", "");
                                }
                                if (target_table == 'covukhi') {
                                    $("#vukhi").select2("val", "");
                                }

                            }
                        });
                    }
                    ;
                    if (target_table == 'covukhi') {
                        $("#vukhi").select2("val", "");
                    }
                    ;
                    var donvixuat_id = $("#donvixuat").val();
                    var hevukhi_id = $("#hevukhi").val();
                    var nhomvukhi_id = $("#nhomvukhi").val();
                    var covukhi_id = $("#covukhi").val();
                    var vukhi_id = $("#vukhi").val();
                    var donvitinh_id = $("#donvitinh").val();
                    var nuocsanxuat_id = $("#nuocsanxuat").val();
                    if (hevukhi_id == null || nhomvukhi_id == null || covukhi_id == null || vukhi_id == null || donvitinh_id == null || nuocsanxuat == null || donvixuat_id == null) {
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
//                                console.log(data);
//                                if(data.code = )
                                if (data) {
                                    $('#cap_1').text(data.cap_1);
                                    $('#cap_2').text(data.cap_2);
                                    $('#cap_3').text(data.cap_3);
                                    $('#cap_4').text(data.cap_4);
                                    $('#cap_5').text(data.cap_5);
                                } else {
                                    $('#cap_1').text('');
                                    $('#cap_2').text('');
                                    $('#cap_3').text('');
                                    $('#cap_4').text('');
                                    $('#cap_5').text('');
                                }
                            }
                        });
                    }
                });
            });

        </script>
@endsection