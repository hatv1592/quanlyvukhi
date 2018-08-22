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
                                    <select id="cancu" name="phieuxuatkho[cancuxuatkho_id]"
                                            class="select2_single form-control"
                                            tabindex="-1">
                                        @foreach ($canCuXuatKho as $key => $eachCanCuXuatKho)
                                            <option value="{{$key}}" <?php echo ($phieuXuatKho->cancuxuatkho_id == $key) ? 'selected="selected"' : '' ?> >{{$eachCanCuXuatKho}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="old_phieuxuatkho[cancuxuatkho_id]"
                                           value="<?php echo $phieuXuatKho->cancuxuatkho_id ?>">
                                </div>
                                <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị xuất</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="donvixuat" name="phieuxuatkho[donvixuat_id]"
                                            class="select2_single form-control" tabindex="-1">
                                        @foreach ($donViXuat as $key => $eachDonViXuat)
                                            <option value="{{$key}}" <?php echo ($phieuXuatKho->donvixuat_id == $key) ? 'selected="selected"' : '' ?>>{{$eachDonViXuat}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="old_phieuxuatkho[donvixuat_id]"
                                           value="<?php echo $phieuXuatKho->donvixuat_id ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lydoxuatkho_id" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Về việc</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="lydoxuat" name="phieuxuatkho[lydoxuatkho_id]"
                                            class="select2_single form-control" tabindex="-1">
                                        @foreach ($lyDoXuatKho as $key => $eachLyDoXuatKho)
                                            <option value="{{$key}}" <?php echo ($phieuXuatKho->lydoxuatkho_id == $key) ? 'selected="selected"' : '' ?> >{{$eachLyDoXuatKho}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="old_phieuxuatkho[lydoxuatkho_id]"
                                           value="<?php echo $phieuXuatKho->lydoxuatkho_id ?>">
                                </div>
                                <label for="donvi_id" class="control-label col-md-2 col-xs-12" style="text-align:left;">Đơn
                                    vị nhập</label>
                                <div class="col-md-3 col-sm-3 col-xs-9">
                                    <select id="donvinhap" name="phieuxuatkho[donvinhap_id]"
                                            class="select2_single form-control" tabindex="-1">
                                        @foreach ($donViNhap as $key => $eachDonViNhap)
                                            <option <?php echo ($phieuXuatKho->donvinhap_id == $key) ? 'selected="selected"' : '' ?> value="{{$key}}">{{$eachDonViNhap}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="old_phieuxuatkho[donvinhap_id]"
                                           value="<?php echo $phieuXuatKho->donvinhap_id ?>">
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-3">
                                    <a class="btn btn-md btn-info">
                                        Tạo
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pxk_ngay_hethan" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Ngày hết hạn</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo date('d-m-Y', strtotime($phieuXuatKho->pxk_ngay_hethan))?>"
                                           id="pxk_ngay_hethan"
                                           name="phieuxuatkho[pxk_ngay_hethan]" type="text"
                                           class="form-control"
                                           placeholder="">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_ngay_hethan]"
                                           value="<?php echo date('d-m-Y', strtotime($phieuXuatKho->pxk_ngay_hethan))?>">
                                </div>
                                <label for="pxk_donvivanchuyen" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị vận chuyển</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo $phieuXuatKho->pxk_donvivanchuyen?>"
                                           id="pxk_donvivanchuyen" name="phieuxuatkho[pxk_donvivanchuyen]" type="text"
                                           class="form-control">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_donvivanchuyen]"
                                           value="<?php echo $phieuXuatKho->pxk_donvivanchuyen ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pxk_nguoinhan" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Người nhận hàng</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo $phieuXuatKho->pxk_nguoinhan?>" id="pxk_nguoinhan"
                                           name="phieuxuatkho[pxk_nguoinhan]" type="text"
                                           class="form-control">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_nguoinhan]"
                                           value="<?php echo $phieuXuatKho->pxk_nguoinhan ?>">
                                </div>
                                <label for="pxk_phuongtienvanchuyen" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Phương tiện vận chuyển</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo $phieuXuatKho->pxk_phuongtienvanchuyen?>"
                                           id="pxk_phuongtienvanchuyen" name="phieuxuatkho[pxk_phuongtienvanchuyen]"
                                           type="text" class="form-control">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_phuongtienvanchuyen]"
                                           value="<?php echo $phieuXuatKho->pxk_phuongtienvanchuyen ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pxk_nguoinhanphieu" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Người nhận phiếu</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo $phieuXuatKho->pxk_nguoinhanphieu?>"
                                           id="pxk_nguoinhanphieu" name="phieuxuatkho[pxk_nguoinhanphieu]" type="text"
                                           class="form-control">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_nguoinhanphieu]"
                                           value="<?php echo $phieuXuatKho->pxk_nguoinhanphieu ?>">
                                </div>
                                <label for="pxk_nguoiralenh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Thủ trưởng ra lệnh</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?php echo $phieuXuatKho->pxk_nguoiralenh?>" id="pxk_nguoiralenh"
                                           name="phieuxuatkho[pxk_nguoiralenh]" type="text"
                                           class="form-control">
                                    <input type="hidden" name="old_phieuxuatkho[pxk_nguoiralenh]"
                                           value="<?php echo $phieuXuatKho->pxk_nguoiralenh ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="hevukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Hệ
                                    vũ khí</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="hevukhi" name="vukhi[hevukhi]" target-table="hevukhi"
                                            update="nhomvukhi" class="select2_single form-control qlvk" tabindex="-1">
                                        <?php foreach ($heVuKhi as $key => $eachHeVuKhi) { ?>
                                        <?php echo '<option value="' . $key . '">' . $eachHeVuKhi . '</option>' ?>
                                    <?php } ?>
                                    </select>
                                </div>
                                <label for="nhomvukhi" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nhóm vũ khí</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select disabled id="nhomvukhi" name="vukhi[nhomvukhi]"
                                            target-table="nhomvukhi"
                                            update="covukhi" class="select2_single form-control qlvk" tabindex="-1">
                                        <!--<option value="0" >Chọn</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="covukhi" class="control-label col-md-2 col-xs-12" for="covukhi"
                                       style="text-align:left;">Cỡ vũ khí</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <select disabled id="covukhi" name="vukhi[covukhi]" target-table="covukhi"
                                            update="vukhi" class="select2_single form-control qlvk" tabindex="-1">
                                        <!--<option value="0" >Chọn</option>-->
                                    </select>
                                </div>
                                <label for="vukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Vũ
                                    khí</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select disabled id="vukhi" name="vukhi[vukhi]" target-table="vukhi"
                                            update="donvitinh" class="select2_single form-control" tabindex="-1">
                                        <!--<option value="0" >Chọn</option>-->

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="donvitinh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị tính</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="donvitinh" name="vukhi[donvitinh]"
                                            class="select2_single form-control" tabindex="-1">
                                        <?php foreach ($donViTinh as $key => $eachDonViTinh) { ?>
                                        <?php echo '<option value="' . $key . '">' . $eachDonViTinh . '</option>' ?>
                                    <?php } ?>
                                    </select>
                                </div>
                                <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nước sản xuất</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select disabled id="nuocsanxuat" name="vukhi[nuocsanxuat]"
                                            class="select2_single form-control" tabindex="-1">
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
                                        <input id="cap1" name="nhapton[cap1]" type="text" class="chatluong form-control"
                                               placeholder="0">
                                    </div>
                                    <div style="width: 30%;float: left;padding-left: 5px;text-align: center">
                                        <span id="cap_1" style="line-height: 30px;color: red"></span>
                                    </div>
                                </div>
                                <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                    <label for="cap2" class="control-label"
                                           style="width: 30%; float: left;text-align: center">Cấp 2:</label>
                                    <div style="width: 40%;float: left">
                                        <input id="cap2" name="nhapton[cap2]" type="text" class="chatluong form-control"
                                               placeholder="0">
                                    </div>
                                    <div style="width: 30%;float: left;padding-left: 5px;text-align: center">
                                        <span id="cap_2" style="line-height: 30px;color: red"></span>
                                    </div>
                                </div>
                                <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                    <label for="cap3" class="control-label"
                                           style="width: 30%; float: left;text-align: center">Cấp 3:</label>
                                    <div style="width: 40%;float: left">
                                        <input id="cap3" name="nhapton[cap3]" type="text" class="chatluong form-control"
                                               placeholder="0">
                                    </div>
                                    <div style="width: 30%;float: left;padding-left: 5px;text-align: center">
                                        <span id="cap_3" style="line-height: 30px;color: red"></span>
                                    </div>
                                </div>
                                <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                                    <label for="cap4" class="control-label"
                                           style="width: 30%; float: left;text-align: center">Cấp 4:</label>
                                    <div style="width: 40%;float: left">
                                        <input id="cap4" name="nhapton[cap4]" type="text" class="chatluong form-control"
                                               placeholder="0">
                                    </div>
                                    <div style="width: 30%;float: left;padding-left: 5px;text-align: center">
                                        <span id="cap_4" style="line-height: 30px;color: red"></span>
                                    </div>
                                </div>
                                <div style="width: 20%;float: left;border-left: 1px solid #ccc;border-right: 1px solid #ccc">
                                    <label for="cap5" class="control-label"
                                           style="width: 30%; float: left;text-align: center">Cấp 5:</label>
                                    <div style="width: 40%;float: left">
                                        <input id="cap5" name="nhapton[cap5]" type="text" class="chatluong form-control"
                                               placeholder="0">
                                    </div>
                                    <div style="width: 30%;float: left;padding-left: 5px;text-align: center">
                                        <span id="cap_5" style="line-height: 30px;color: red;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                                    <input type="submit" value="Xuất kho" name="add" class="btn btn-primary"/>
                                    {{--<form action="{{url('/xuatnhap/phieuxuatkho/finish',$phieuXuatKho->pxk_id)}}"--}}
                                    {{--method="post">--}}
                                    <input type="submit" value="In/ Kết thúc" name="finish" class="btn btn-success"/>
                                    {{--</form>--}}

                                    <a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-danger">Thoát</a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_content">
                                    <table class="table table-bordered" style="text-align: center">
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
                                        @foreach($phieuXuatKhoChiTiet as $eachPhieuXuatKhoChiTiet)
                                            <tr>
                                                <td style="text-align: center">{{$eachPhieuXuatKhoChiTiet->pxk_chitiet_id}}</td>
                                                <td class="text-left">{{$eachPhieuXuatKhoChiTiet->thucLucVuKhiChiTiet->vukhi->vukhi_name}}</td>
                                                <td style="text-align: center">{{$eachPhieuXuatKhoChiTiet->thucLucVuKhiChiTiet->nuocsanxuat->nuocsanxuat_name}}</td>
                                                <td style="text-align: center">{{$eachPhieuXuatKhoChiTiet->thucLucVuKhiChiTiet->donvitinh->donvitinh_name}}</td>
                                                <td>{{$eachPhieuXuatKhoChiTiet->thucLucVuKhiChiTiet->phancap_id}}</td>
                                                <td>{{$eachPhieuXuatKhoChiTiet->soluong_kehoach}}</td>
                                                <td><a href="" class="btn btn-xs btn-danger"><i class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
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
                });
                $('select#nuocsanxuat').on('change', function () {
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