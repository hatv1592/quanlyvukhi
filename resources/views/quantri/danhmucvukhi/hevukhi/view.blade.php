@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12 hevukhi">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị hệ vũ khí</h2>
                <ul class="nav navbar-right panel_toolbox">
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
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy hệ vũ khí với ID
                                    = {{ $id }}</h3>
                                <a href="{{ route('quantri.danhmucvukhi.hevukhi.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Sửa hệ vũ khí</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmucvukhi.hevukhi.update', $weapon->hevukhi_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('hevukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_code', 'Mã hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('hevukhi_code', $weapon->hevukhi_code, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã hệ vũ khí']) !!}
                                    @if ($errors->has('hevukhi_code'))
                                        <span class="help-block">{{ $errors->first('hevukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('hevukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_name', 'Tên hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('hevukhi_name', $weapon->hevukhi_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên hệ vũ khí']) !!}
                                    @if ($errors->has('hevukhi_name'))
                                        <span class="help-block">{{ $errors->first('hevukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('hevukhi_active', null,  $weapon->hevukhi_active == 1 ? ['checked'] : []) !!}
                                            Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.hevukhi.delete({{ $weapon->hevukhi_id }}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('quantri.danhmucvukhi.hevukhi.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmucvukhi.hevukhi.index') }}" class="btn btn-warning">Quay
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
    <link href="{{URL::asset('public/css/hevukhi.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script src="{{ URL::asset('public/js/hevukhi.js') }}"></script>
    <script>
        @if(session('update-hevukhi-success'))
            sweetAlert({
            title: "{{ session('update-hevukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection