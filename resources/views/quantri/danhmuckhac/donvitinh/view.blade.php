@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị đơn vị tính</h2>
                <ul class="nav navbar-right panel_toolbox reset-min-with">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="x_panel">
                    @if (isset($notFound) && $notFound)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy đơn vị tính với ID
                                    = {{ $id  }}</h3>
                                <a href="{{ route('quantri.danhmuckhac.donvitinh.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Sửa đơn vị tính</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmuckhac.donvitinh.update', $calculationUnit->donvitinh_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('donvitinh_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvitinh_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvitinh_name', $calculationUnit->donvitinh_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên đơn vị tính']) !!}
                                    @if ($errors->has('donvitinh_name'))
                                        <span class="help-block">{{ $errors->first('donvitinh_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group text-center">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('donvitinh_active', null, $calculationUnit->donvitinh_active === 1 ? ['checked'] : []) !!}
                                            Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.donvitinh.delete({{ $calculationUnit->donvitinh_id }}).then(function(isConfirm) { if (isConfirm) {  window.location = '{{ route('quantri.danhmuckhac.donvitinh.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmuckhac.donvitinh.index') }}"
                                       class="btn btn-warning">Quay
                                        lại</a>
                                </div>

                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    @endif
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
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script src="{{ URL::asset('public/js/donvitinh.js') }}"></script>
    <script>
        @if(session('update-donvitinh-success'))
            sweetAlert({
            title: "{{ session('update-donvitinh-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection