@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị cỡ vũ khí</h2>
                <ul class="nav navbar-right panel_toolbox reset-min-with">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="x_panel">
                    @if (isset($notFound) &&  $notFound)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy cỡ vũ khí với ID = {{ $id }}
                                    .</h3>
                                <a href="{{ route('quantri.danhmucvukhi.covukhi.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase text-center">Sửa cỡ vũ khí</h3>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmucvukhi.covukhi.update', $weaponSize->covukhi_id), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('nhomvukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('nhomvukhi_id', 'Nhóm vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::select('nhomvukhi_id', $weaponGroups, $weaponSize->nhomvukhi_id, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('nhomvukhi_id'))
                                        <span class="help-block">{{ $errors->first('nhomvukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('covukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_code', 'Mã cỡ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('covukhi_code', $weaponSize->covukhi_code, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã cỡ vũ khí']) !!}
                                    @if ($errors->has('covukhi_code'))
                                        <span class="help-block">{{ $errors->first('covukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('covukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_name', 'Tên cỡ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('covukhi_name', $weaponSize->covukhi_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cỡ vũ khí']) !!}
                                    @if ($errors->has('covukhi_name'))
                                        <span class="help-block">{{ $errors->first('covukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('covukhi_active', null, $weaponSize->covukhi_active == 1 ? ['checked'] : []) !!}
                                            Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                                    <button type="button"
                                            onclick="app.covukhi.delete({{ $weaponSize->covukhi_id }}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('quantri.danhmucvukhi.covukhi.index') }}'; } })"
                                            class="btn btn-danger">Xóa
                                    </button>
                                    <a href="{{ route('quantri.danhmucvukhi.covukhi.index') }}" class="btn btn-warning">Quay
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
    <script src="{{ URL::asset('public/js/covukhi.js') }}"></script>
    <script>
        @if(session('update-covukhi-success'))
            sweetAlert({
            title: "{{ session('update-covukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection