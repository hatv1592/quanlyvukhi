@extends('../master')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <h3 style="text-align:center;text-transform: uppercase;font-size: 20px">Thêm căn cứ xuất kho</h3>
                <div class="x_panel">
                    <div>
                        <form class="form-horizontal form-label-left" action="{{ route('xuatnhap.nhapcancuxuatkho') }} "
                              method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="malenh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Mã lệnh</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <?php
                                    $old_value = array();
                                    if (null !== Session::get('model')) {
                                        $old_value = Session::get('model');
                                    }
                                    ?>
                                    <input value="<?php echo (isset($old_value['cancuxuatkho_code'])) ?
                                            $old_value['cancuxuatkho_code'] : ''; ?>" id="malenh" type="text"
                                           class="form-control" placeholder="Nhập mã lệnh..."
                                           name="cancuxuatkho[cancuxuatkho_code]">
                                </div>
                                <label for="solenh" class="control-label col-md-2 col-xs-12" style="text-align:left;">Số
                                    lệnh</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="solenh" type="text" class="form-control"
                                           value="<?php echo (isset($old_value['cancuxuatkho_number'])) ?
                                                   $old_value['cancuxuatkho_number'] : ''; ?>"
                                           name="cancuxuatkho[cancuxuatkho_number]"
                                           placeholder="Nhập số lệnh...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="coquan" class="control-label col-md-2 col-xs-12" style="text-align:left;">Cơ
                                    quan ra lệnh</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="coquan" type="text" class="form-control"
                                           value="<?php echo (isset($old_value['cancuxuatkho_cqralenh'])) ?
                                                   $old_value['cancuxuatkho_cqralenh'] : ''; ?>"
                                           name="cancuxuatkho[cancuxuatkho_cqralenh]"
                                           placeholder="Nhập cơ quan ra lệnh...">
                                </div>
                                <label for="cancuxuatkho_date" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Ngày nhận lệnh</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="cancuxuatkho_date" type="text" class="date-picker form-control"
                                           value="<?php
                                           if (isset($old_value['cancuxuatkho_date'])) {
                                               $date = \DateTime::createFromFormat('Y-m-d', $old_value['cancuxuatkho_date']);
                                               echo $date->format('d-m-Y');
                                           } else {
                                               echo trim(date('d-m-Y', time()));
                                           }
                                           ?>"
                                           name="cancuxuatkho[cancuxuatkho_date]"
                                           placeholder="Nhập cơ quan ra lệnh...">
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        $('#cancuxuatkho_date').daterangepicker({
                                            singleDatePicker: true,
                                            calender_style: "picker_4",
                                            format: 'DD-MM-YYYY',
                                        }, function (start, end, label) {
                                            console.log(start.toISOString(), end.toISOString(), label);
                                        });
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="cancuxuatkho_name" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Tên hiển thị</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="coquan" type="text" class="form-control"
                                           value="<?php echo (isset($old_value['cancuxuatkho_name'])) ?
                                                   $old_value['cancuxuatkho_name'] : ''; ?>"
                                           name="cancuxuatkho[cancuxuatkho_name]"
                                           placeholder="Tên hiển thị">
                                </div>
                                <label for="cancuxuatkho_note" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Mô tả</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="cancuxuatkho_note" type="text" class="form-control"
                                           value="<?php echo (isset($old_value['cancuxuatkho_note'])) ?
                                                   $old_value['cancuxuatkho_note'] : ''; ?>"
                                           name="cancuxuatkho[cancuxuatkho_note]"
                                           placeholder="Ghi chú">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Thêm căn cứ</button>
                                    <button type="reset" class="btn btn-success">Nhập lại</button>
                                    <a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-danger">Thoát</a>
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
                                            <th rowspan="1">Mã lệnh</th>
                                            <th rowspan="1">Số lệnh</th>
                                            <th rowspan="1">Cơ quan ra lệnh</th>
                                            <th colspan="1" style="border-bottom: none;">Ngày nhận lệnh</th>
                                            <th colspan="1" style="border-bottom: none;">Tên hiển thị</th>
                                            <th colspan="1" style="border-bottom: none;">Ghi chú</th>
                                            <th colspan="1" style="border-bottom: none;">Hoạt động</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php foreach($cancuxuatkho as $key=> $each_can_cu){?>
                                        <tr>
                                            <td class="text-left">{{$each_can_cu->cancuxuatkho_id}}</td>
                                            <td style="text-align: center">{{$each_can_cu->cancuxuatkho_code}}</td>
                                            <td style="text-align: center"{{$each_can_cu->cancuxuatkho_number}}</td>
                                            <td style="width: ">{{$each_can_cu->cancuxuatkho_cqralenh}}</td>
                                            <td style="width: ">{{$each_can_cu->cancuxuatkho_date}}</td>
                                            <td style="width: ">{{$each_can_cu->cancuxuatkho_name}}</td>
                                            <td style="width: ">{{$each_can_cu->cancuxuatkho_note}}</td>
                                            <td style="width: ">
                                                <a class="btn btn-info btn-xs btn-danger"> <i class="fa fa-close"></i></a>
                                                <a href="" class="btn btn-info btn-xs btn-info"> <i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                    {!! $cancuxuatkho->render() !!}
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