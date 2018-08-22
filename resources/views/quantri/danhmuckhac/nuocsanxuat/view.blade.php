@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị nước sản xuất</h2>
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
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy nước sản xuất với ID
                                    = {{ $id  }}</h3>
                                <a href="{{ route('quantri.danhmuckhac.nuocsanxuat.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Cập nhật thông tin nước sản xuất</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmuckhac.nuocsanxuat.update', $country->nuocsanxuat_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('hevukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_id', 'Hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::select('hevukhi_id', $weaponSystems, $country->hevukhi_id, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('hevukhi_id'))
                                        <span class="help-block">{{ $errors->first('hevukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('nuocsanxuat_name') ? 'has-error' : '' }}">
                                    {!! Form::label('nuocsanxuat_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('nuocsanxuat_name', $country->nuocsanxuat_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên nước sản xuất']) !!}
                                    @if ($errors->has('nuocsanxuat_name'))
                                        <span class="help-block">{{ $errors->first('nuocsanxuat_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group text-center" >
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('nuocsanxuat_active', null, $country->nuocsanxuat_active == 1 ? ['checked'] : []) !!}
                                            Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.nuocsanxuat.delete({{ $country->nuocsanxuat_id }}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('quantri.danhmuckhac.nuocsanxuat.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmuckhac.nuocsanxuat.index') }}"
                                       class="btn btn-warning">Quay lại</a>
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
    <script src="{{ URL::asset('public/js/nuocsanxuat.js') }}"></script>

    <script>
        @if(session('update-nuocsanxuat-success'))
            sweetAlert({
            title: "{{ session('update-nuocsanxuat-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection