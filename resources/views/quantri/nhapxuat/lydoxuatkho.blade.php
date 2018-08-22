@extends('../master')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <h3 style="text-align:center;text-transform: uppercase">Nhập lý do xuất kho</h3>
                <div class="x_panel">
                    <div>
                        <form class="form-horizontal form-label-left"
                              action="{{ route('quantri.xuatnhap.taolydoxuatkho') }} " method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="tenlodo" class="control-label col-md-2 col-xs-12 col-md-offset-2"
                                       style="text-align:left;">Tên lý do xuất kho</label>
                                <div class="col-md-4 col-sm-4 col-xs-12 ">
                                    <input name="lydoxuatkho[lydoxuatkho_name]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12 col-md-offset-2"
                                       style="text-align:left;">Ghi chú xuất kho</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input name="lydoxuatkho[lydoxuatkho_note]" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-xs-12 col-md-offset-2"
                                       style="text-align:left;">Trạng thái</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="">
                                        <label>
                                            <input name="lydoxuatkho[lydoxuatkho_active]" type="checkbox"
                                                   class="js-switch" checked/> Checked
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Nhập</button>
                                    <a class="btn btn-danger" href="{{url('')}}">Thoát</a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_title">
                                </div>
                                <div class="x_content">
                                    <table class="table table-bordered text-center" id="">
                                        <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                        <thead style="text-align: center">
                                        <tr>
                                            <th rowspan="">STT</th>
                                            <th rowspan="">Tên lý do xuất kho</th>
                                            <th rowspan="">Ghi chú</th>
                                            <th rowspan="">Trạng thái</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($lydoxuatkho as $lydoxuatkho_item) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $lydoxuatkho_item->lydoxuatkho_id ?></td>
                                            <td class="text-left"><?php echo $lydoxuatkho_item->lydoxuatkho_name ?></td>
                                            <td style=""><?php echo $lydoxuatkho_item->lydoxuatkho_note ?></td>
                                            <td style=""><?php echo $lydoxuatkho_item->lydoxuatkho_active ?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    {!! $lydoxuatkho->render() !!}
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