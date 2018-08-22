@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị đơn vị</h2>
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
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy đơn vị với ID
                                    = {{ $id  }}</h3>
                                <a href="{{ route('quantri.danhmucdonvi.donvi.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Cập nhật thông tin đơn vị</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmucdonvi.donvi.update', $unit->donvi_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('donvi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvi_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvi_name', $unit->donvi_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên đơn vị']) !!}
                                    @if ($errors->has('donvi_name'))
                                        <span class="help-block">{{ $errors->first('donvi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('donvi_short_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvi_short_name', 'Mô tả', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvi_short_name', $unit->donvi_short_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên viết tắt']) !!}
                                    @if ($errors->has('donvi_short_name'))
                                        <span class="help-block">{{ $errors->first('donvi_short_name') }}</span>
                                    @endif
                                </div>

                                @if (!isset($parentIdDonvi))
                                    <div class="form-group {{ $errors->has('donvi_parent') ? 'has-error' : '' }}">
                                        {!! Form::label('donvi_parent', 'Đơn vị cha', ['class' => 'control-label']) !!}
                                        {!! Form::select('donvi_parent', $parentUnits, $unit->donvi_parent, ['class' => 'form-control select2_single']) !!}
                                        @if ($errors->has('donvi_parent'))
                                            <span class="help-block">{{ $errors->first('donvi_parent') }}</span>
                                        @endif
                                    </div>
                                @endif
                                <hr>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.donvi.delete({{ $unit->donvi_id }}).then(function(isConfirm) { if (isConfirm) {  window.location = '{{ route('quantri.danhmucdonvi.donvi.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmucdonvi.donvi.index') }}" class="btn btn-warning">Quay
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
    <script src="{{ URL::asset('public/js/donvi.js') }}"></script>
    <script>
        @if(session('update-donvi-success'))
            sweetAlert({
            title: "{{ session('update-donvi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection