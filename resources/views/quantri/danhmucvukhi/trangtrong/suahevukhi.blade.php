@extends('../master')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản trị hệ vũ khí
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench">abc</i></a>
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
            <h3 style="text-align:center;text-transform: uppercase">Quản trị hệ vũ khi</h3>
            <div class="x_panel">
                <div>
                    <form class="form-horizontal form-label-left" action="{{ route('quantri.danhmucvukhi.taohevukhi') }} " method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="tenlodo" class="control-label col-md-2 col-xs-12 col-md-offset-2" style="text-align:left;">Mã hệ vũ khí</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 ">
                                <input name="hevukhi[hevukhi_code]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12 col-md-offset-2" style="text-align:left;">Tên hệ vũ khí</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input name="hevukhi[hevukhi_name]" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-xs-12 col-md-offset-2" style="text-align:left;">Trạng thái</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="">
                                    <label>
                                        <input name="hevukhi[hevukhi_active]" type="checkbox" class="js-switch" checked /> Checked
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-0">
                                <button type="submit" class="btn btn-primary">Nhập</button>
                                <button class="btn btn-danger">Thoát</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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