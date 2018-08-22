@extends('../master')
@section('content')
<div class="col-md-12" id="search-xuatkho">
    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw icon-loading" v-show="loading"></i>

    <div :class="{'x_panel': true, 'blur': loading}">
        <div class="x_title">
            <h2 class="text-uppercase">Tìm kiếm lệnh xuất kho</h2>
            <ul class="nav navbar-right panel_toolbox reset-min-with">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form class="form-horizontal table-custom">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="donvi_id" class="col-md-4 control-label text-left">Đơn vị</label>
                            <div class="col-md-8">
                                <select-box :data="{{ json_encode($donvi) }}" model="donvi_id"></select-box>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="lydonhapkho_id" class="col-md-4 control-label text-left">Lý do xuất kho</label>
                            <div class="col-md-8">
                                <select-box :data="{{ json_encode($lydoxuatkho) }}" model="lydoxuatkho_id"></select-box>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4 control-label text-left">Số lệnh</label>
                            <div class="col-md-8">
                                <input-text model="solenh"></input-text>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="from-date" class="col-md-4 control-label text-left">Từ ngày</label>
                            <div class="col-md-8">
                                <datepicker model="from_date"></datepicker>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="nuocsanxuat_id" class="col-md-4 control-label text-left">Đến ngày</label>
                            <div class="col-md-8">
                                <datepicker model="to_date"></datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <hr>

            <h3 class="text-center text-uppercase">Danh sách lệnh xuất kho</h3>

            <div class="row">
                <div class="col-md-12">
                    <total :data="data" text="lệnh xuất kho"></total>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table-list :data="data"></table-list>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <pagination :current-page="currentPage"
                                :per-page="itemPerPage"
                                :total="total"
                                :on-page-changed="changePage">
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extension.style')
    <link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="{{URL::asset('public/css/common.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/bower_components/vue/dist/vue.min.js"></script>
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/config.js') }}"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script src="{{ URL::asset('public/js/component.js') }}"></script>
    <script src="{{ URL::asset('public/js/search-xuatkho.js') }}"></script>
@endsection