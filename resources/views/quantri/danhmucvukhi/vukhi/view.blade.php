@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị vũ khí</h2>
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
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy vũ khí với ID
                                    = {{ $id  }}</h3>
                                <a href="{{ route('quantri.danhmucvukhi.vukhi.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Sửa vũ khí</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmucvukhi.vukhi.update', $weapon->vukhi_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('covukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_id', 'Kích cỡ', ['class' => 'control-label']) !!}
                                    {!! Form::select('covukhi_id', $weaponSizes, $weapon->covukhi_id, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('covukhi_id'))
                                        <span class="help-block">{{ $errors->first('covukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_code', 'Mã', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_code', $weapon->vukhi_code, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã vũ khí']) !!}
                                    @if ($errors->has('vukhi_code'))
                                        <span class="help-block">{{ $errors->first('vukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_name', $weapon->vukhi_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên vũ khí']) !!}
                                    @if ($errors->has('vukhi_name'))
                                        <span class="help-block">{{ $errors->first('vukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_kyhieu') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_kyhieu', 'Ký hiệu', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_kyhieu', $weapon->vukhi_kyhieu, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập ký hiệu vũ khí']) !!}
                                    @if ($errors->has('vukhi_kyhieu'))
                                        <span class="help-block">{{ $errors->first('vukhi_kyhieu') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_trongluong') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_trongluong', 'Trọng lượng', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_trongluong', $weapon->vukhi_trongluong, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập trọng lượng vũ khí']) !!}
                                    @if ($errors->has('vukhi_trongluong'))
                                        <span class="help-block">{{ $errors->first('vukhi_trongluong') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_dai') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_dai', 'Chiều dài', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_dai', $weapon->vukhi_dai, ['class' => 'form-control', 'placeholder' => 'Chiều dài vũ khí']) !!}
                                            @if ($errors->has('vukhi_dai'))
                                                <span class="help-block">{{ $errors->first('vukhi_dai') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_rong') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_rong', 'Chiều rộng', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_rong', $weapon->vukhi_rong, ['class' => 'form-control', 'placeholder' => 'Chiều rộng vũ khí']) !!}
                                            @if ($errors->has('vukhi_rong'))
                                                <span class="help-block">{{ $errors->first('vukhi_rong') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_cao') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_cao', 'Chiều cao', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_cao', $weapon->vukhi_cao, ['class' => 'form-control', 'placeholder' => 'Chiều cao vũ khí']) !!}
                                            @if ($errors->has('vukhi_cao'))
                                                <span class="help-block">{{ $errors->first('vukhi_cao') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('vukhi_active', null, $weapon->vukhi_active == 1 ? ['checked'] : []) !!}
                                            Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.vukhi.delete({{ $weapon->vukhi_id }}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('quantri.danhmucvukhi.vukhi.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmucvukhi.vukhi.index') }}" class="btn btn-warning">Quay
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
    <script src="{{ URL::asset('public/js/vukhi.js') }}"></script>
    <script>
        @if(session('update-vukhi-success'))
            sweetAlert({
            title: "{{ session('update-vukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection