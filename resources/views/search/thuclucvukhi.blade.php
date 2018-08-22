@extends('../master')
@section('content')
<div class="col-md-12" id="search-thucluc-vukhi">
    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw icon-loading" v-show="loading"></i>

    <div :class="{'x_panel': true, 'blur': loading}">
        <div class="x_title">
            <h2 class="text-uppercase">Tìm kiếm thực lực vũ khí</h2>
            <ul class="nav navbar-right panel_toolbox reset-min-with">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            {!! Form::open(['url' => '', 'class' => 'form-horizontal table-custom']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="donvi_id" class="col-md-4 control-label text-left">Đơn vị</label>
                            <div class="col-md-8">
                                <select-box :data="{{ json_encode($donvi) }}" model="donvi_id"></select-box>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-4 control-label text-left">Số hiệu</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="hevukhi_id" class="col-md-4 control-label text-left">Hệ vũ khí</label>
                            <div class="col-md-8">
                                <select-box :data="{{ json_encode($hevukhi) }}" model="hevukhi_id"></select-box>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="covukhi_id" class="col-md-4 control-label text-left">Cỡ vũ khí</label>
                            <div class="col-md-8">
                                <select-box
                                        :data="{{ json_encode($covukhi) }}"
                                        model="covukhi_id"
                                        is-disabled="true"
                                        v-ref:covukhi>
                                </select-box>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="donvitinh_id" class="col-md-4 control-label text-left">Đơn vị tính</label>
                            <div class="col-md-8">
                                <select-box :data="{{ json_encode($donvitinh) }}" model="donvitinh_id"></select-box>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="nhomvukhi_id" class="col-md-4 control-label text-left">Nhóm vũ khí</label>
                            <div class="col-md-8">
                                <select-box
                                        :data="{{ json_encode($nhomvukhi) }}"
                                        model="nhomvukhi_id"
                                        is-disabled="true"
                                        v-ref:nhomvukhi>
                                </select-box>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="vukhi_id" class="col-md-4 control-label text-left">Vũ khí</label>
                            <div class="col-md-8">
                                <select-box
                                        :data="{{ json_encode($vukhi) }}"
                                        model="vukhi_id"
                                        is-disabled="true"
                                        v-ref:vukhi>
                                </select-box>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="nuocsanxuat_id" class="col-md-4 control-label text-left">Nước sản xuất</label>
                            <div class="col-md-8">
                                <select-box
                                        :data="{{ json_encode($nuocsanxuat) }}"
                                        model="nuocsanxuat_id"
                                        is-disabled="true"
                                        v-ref:nuocsanxuat>
                                </select-box>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            <hr>

            <h3 class="text-center text-uppercase">Danh sách thực lực vũ khí</h3>

            <div class="row">
                <div class="col-md-12">
                    <total :data="data" text="thực lực vũ khí"></total>
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
    <link href="{{URL::asset('public/css/search-vukhi.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/bower_components/vue/dist/vue.min.js"></script>
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/config.js') }}"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script src="{{ URL::asset('public/js/component.js') }}"></script>
    <script src="{{ URL::asset('public/js/search-thucluc-vukhi.js') }}"></script>
    <script>
        @if(session('add-donvitinh-success'))
            sweetAlert({
            title: "{{ session('add-donvitinh-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection