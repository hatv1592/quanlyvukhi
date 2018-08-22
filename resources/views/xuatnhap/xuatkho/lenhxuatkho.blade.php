@extends('../master')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Xuất nhập
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h3 style="text-align:center;text-transform: uppercase">Danh sách lệnh xuất kho</h3>
            <div class="x_panel">
                <div>
                    <form class="form-horizontal form-label-left" action="{{ route('tonkho.update') }} " method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!--                        <div class="form-group">
                                                    <label for="donvi" class="control-label col-md-2 col-xs-12 col-md-offset-0" style="text-align:left;">Căn cứ vào</label>
                                                    <div class="col-md-4 col-sm-10 col-xs-12">
                                                        <select id="donvi" name="nhapton[donvi]" class="select2_single form-control" tabindex="-1">
                                                            <option value="">Chọn</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                        <!--<hr/>-->


                        <div class="form-group">
                            <label for="donvitinh" class="control-label col-md-2 col-xs-12" style="text-align:left;">Người nhận hàng</label>
                            <div  class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                            <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12" style="text-align:left;">Phương tiện vận chuyển</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="donvitinh" class="control-label col-md-2 col-xs-12" style="text-align:left;">Người nhận phiếu</label>
                            <div  class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                            <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12" style="text-align:left;">Thủ trưởng ra lệnh</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="hevukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Hệ vũ khí</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="hevukhi" name="nhapton[hevukhi]"  target-table="hevukhi" update="nhomvukhi" class="select2_single form-control" tabindex="-1">
                                    <option value="">Chọn</option>
                                    <?php foreach ($hevukhi as $key => $tung_he_vk) { ?>
                                        <?php echo '<option value="' . $key . '">' . $tung_he_vk . '</option>' ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="nhomvukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Nhóm vũ khí</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="nhomvukhi" name="nhapton[nhomvukhi]"  target-table="nhomvukhi" update="covukhi" class="select2_single form-control" tabindex="-1">
                                    <!--<option value="0" >Chọn</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="covukhi" class="control-label col-md-2 col-xs-12" for="covukhi"  style="text-align:left;">Cỡ vũ khí</label>
                            <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                <select id="covukhi" name="nhapton[covukhi]"  target-table="covukhi" update="vukhi" class="select2_single form-control"  tabindex="-1">
                                    <!--<option value="0" >Chọn</option>-->
                                </select>
                            </div>
                            <label for="vukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Vũ khí</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="vukhi" name="nhapton[vukhi]"  target-table="vukhi" update="donvitinh" class="select2_single form-control" tabindex="-1">
                                    <!--<option value="0" >Chọn</option>-->

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="donvitinh" class="control-label col-md-2 col-xs-12" style="text-align:left;">Đơn vị tính</label>
                            <div  class="col-md-4 col-sm-4 col-xs-12">
                                <select id="donvitinh" name="nhapton[donvitinh]"  target-table="donvitinh" update="nuocsanxuat" class="select2_single form-control" tabindex="-1">
                                    <option value="0" >Chọn</option>
                                    <?php foreach ($donvitinh as $key => $tung_don_vi_tinh) { ?>
                                        <?php echo '<option value="' . $key . '">' . $tung_don_vi_tinh . '</option>' ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12" style="text-align:left;">Nước sản xuất</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="nuocsanxuat" name="nhapton[nuocsanxuat]" class="select2_single form-control" tabindex="-1">
                                    <!--<option value="0" >Chọn</option>-->
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group table-responsive">
                            <table class="table table-bordered" id="">
                                    <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                <thead style="text-align: center">
                                    <tr>
                                        <th colspan="2">Cấp 1</th>
                                        <th colspan="2">Cấp 2</th>
                                        <th colspan="2">Cấp 3</th>
                                        <th colspan="2">Cấp 4</th>
                                        <th colspan="2">Cấp 5</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Tồn</td>
                                        <td style="text-align: center">Xuất</td>
                                        <td style="text-align: center">Tồn</td>
                                        <td style="text-align: center">Xuất</td>
                                        <td style="text-align: center">Tồn</td>
                                        <td style="text-align: center">Xuất</td>
                                        <td style="text-align: center">Tồn</td>
                                        <td style="text-align: center">Xuất</td>
                                        <td style="text-align: center">Tồn</td>
                                        <td style="text-align: center">Xuất</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="1" style="text-align: center">
                                            20
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            <input id="cap1" name="nhapton[cap1]" type="text" class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            40
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            <input id="cap2" name="nhapton[cap2]" type="text" class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            60
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            <input id="cap3" name="nhapton[cap3]" type="text" class="chatluong form-control col-xs-12" placeholder="0">

                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            70
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            <input id="cap4" name="nhapton[cap4]" type="text" class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            90
                                        </td>
                                        <td colspan="1" style="text-align: center">
                                            <input id="cap5" name="nhapton[cap5]" type="text" class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-0">
                                <button type="submit" class="btn btn-primary">Nhập kho</button>
                                <button class="btn btn-success">Nhập lại</button>
                                <button class="btn btn-danger">Thoát</button>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_title">
                                <!--<h2>Default Example <small>Users</small></h2>-->
                                <!--                                    <ul class="nav navbar-right panel_toolbox">
                                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                        </li>
                                                                        <li class="dropdown">
                                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><a href="#">Settings 1</a>
                                                                                </li>
                                                                                <li><a href="#">Settings 2</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                                        </li>
                                                                    </ul>-->
                                <!--<div class="clearfix"></div>-->
                            </div>
                            <div class="x_content">
                                <table class="table table-bordered" id="">
                                <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                    <thead style="text-align: center">
                                        <tr>
                                            <th rowspan="1">STT</th>
                                            <th rowspan="1" >Tên vũ khí</th>
                                            <th rowspan="1">NSX</th>
                                            <th rowspan="1">ĐVT</th>
                                            <th colspan="1" style="border-bottom: none;">Cấp CL</th>
                                            <th colspan="1" style="border-bottom: none;">Số lượng</th>
                                            <th colspan="1" style="border-bottom: none;">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center">1</td>
                                            <td class="text-left">Pháo mặt đất 152Đ20</td>
                                            <td style="text-align: center">Liên xô</td>
                                            <td style="text-align: center">Khẩu</td>
                                            <td style="width: ">2</td>
                                            <td style="width: ">20</td>
                                            <td style="width: ">Xóa</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">2</td>
                                            <td class="text-left">Pháo mặt đất 152Đ40</td>
                                            <td style="text-align: center">Liên xô</td>
                                            <td style="text-align: center">Khẩu</td>
                                            <td style="width: ">2</td>
                                            <td style="width: ">100</td>
                                            <td style="width: ">Xóa</td>
                                        </tr>

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
</div>
<script>
    $(document).ready(function () {
        $('select.form-control').on('change', function () {
            var target_table_value = $(this).val();
            var target_table = $(this).attr('target-table');
            var update = $(this).attr('update');
            if (target_table_value != 'undefined' && target_table != 'undefined' && update != 'undefined')
                $.ajax({
                    url: '{{ url("/tonkho/gettableoption/")}}',
                    type: 'get',
                    dataType: 'json',
                    data: {"target_table_value": target_table_value, "target_table": target_table, "update": update},
                    beforeSend: function (xhr) {
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.code == 200) {
                            $("#" + update).html(data.html);
                        }
                        if (target_table == 'hevukhi') {
                            $("#nuocsanxuat").html(data.html_nsx);
                        }
                    }
                });
        });
    });
</script>
<!-- Datatables -->
<script>
    function exportData() {
        var handleDataTableButtons = function () {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };
        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
        TableManageButtons.init();
    }
    ;
    strOnLoad += ' exportData();';
</script>
<!-- /Datatables -->

@endsection