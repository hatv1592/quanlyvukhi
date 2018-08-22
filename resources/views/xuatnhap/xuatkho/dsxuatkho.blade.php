@extends('../master')
@section('content')

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
            <h3 style="text-align:center;text-transform: uppercase">Danh sách lệnh xuất kho
                <a href="{{ url('/xuatnhap/nhapcancuxuatkho')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff; text-tra">Nhập căn cứ xuất kho</span>
                </a>
                <a href="{{ url('/xuatnhap/xuatkho')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff">Tạo phiếu xuất kho</span>
                </a>
            </h3>

            <div class="x_panel">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_content">
                        <table class="table table-bordered text-center" id="">
                            <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                            <thead style="text-align: center">
                                <tr>
                                    <th>STT</th>
                                    <th>Số lệnh</th>
                                    <th>Ngày tạo</th>
                                    <th>Đơn vị xuất</th>
                                    <th>Đơn vị nhập</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiêt</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($phieu_xuat_kho as $each_phieu_xuat_kho) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $each_phieu_xuat_kho->pxk_id ?></td>
                                        <td> <?php echo $each_phieu_xuat_kho->pxk_sophieu ?></td>
                                        <td> <?php echo $each_phieu_xuat_kho->pxk_ngay_tao ?></td>
                                        <td> <?php echo $each_phieu_xuat_kho->donvi_id ?></td>
                                        <td> <?php echo $each_phieu_xuat_kho->donvinhap_name ?></td>
                                        <td> <?php
                                            if ($each_phieu_xuat_kho->pxk_status == 1) {
                                                $status = \App\Model\Xuatnhap\PhieuxuatkhoModel::pxk_status();
                                                echo $status[$each_phieu_xuat_kho->pxk_status];
                                            } else {
                                                echo '<a class="btn btn-info btn-xs">Hoàn thiện</a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            if ($each_phieu_xuat_kho->pxk_status == 1) {
                                                echo '<a class="btn btn-info btn-xs btn-danger"> <i class="fa fa-close"></i></a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
        $('select.form-control').on('change', function () {
            var target_table_value = $(this).val();
            var target_table = $(this).attr('target-table');
            var update = $(this).attr('update');
            if (target_table_value != 'undefined' && target_table != 'undefined' && update != 'undefined')
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