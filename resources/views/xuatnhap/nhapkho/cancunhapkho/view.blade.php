@extends('../master')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Căn cứ nhập kho</h2>
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
                            <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy căn cứ nhập kho với ID = {{ $id  }}</h3>
                            <a href="{{ route('xuatnhap.nhapkho.cancunhapkho.index') }}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                @else
                    <h3 class="text-uppercase">Sửa căn cứ nhập kho</h3>

                    {!! Form::open(['url' => route('xuatnhap.nhapkho.cancunhapkho.update', $cancunhapkho->cancunhapkho_id), 'class' => 'form-horizontal form-label-left']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('cancunhapkho_name') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_name', 'Tên căn cứ nhập kho', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_name', $cancunhapkho->cancunhapkho_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên căn cứ nhập kho']) !!}
                                @if ($errors->has('cancunhapkho_name'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancunhapkho_date') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_date', 'Ngày nhận lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_date', date('d-m-Y', strtotime($cancunhapkho->cancunhapkho_date)), ['class' => 'form-control date-picker', 'id' => 'cancunhapkho_date', 'placeholder' => 'Vui lòng nhập ngày nhận lệnh']) !!}
                                @if ($errors->has('cancunhapkho_date'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancunhapkho_note') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_note', 'Ghi chú', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_note', $cancunhapkho->cancunhapkho_note, ['class' => 'form-control', 'placeholder' => 'Ghi chú', 'size' => '20x5']) !!}
                                @if ($errors->has('cancunhapkho_note'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_note') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('cancunhapkho_active', null, $cancunhapkho->cancunhapkho_active === 1 ? ['checked'] : []) !!} Trạng thái
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('cancunhapkho_coquan') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_coquan', 'Tên cơ quan ra lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_coquan', $cancunhapkho->cancunhapkho_coquan, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cơ quan ra lệnh']) !!}
                                @if ($errors->has('cancunhapkho_coquan'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_coquan') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancunhapkho_code') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_code', 'Mã lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_code', $cancunhapkho->cancunhapkho_code, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã lệnh']) !!}
                                @if ($errors->has('cancunhapkho_code'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_code') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancunhapkho_number') ? 'has-error' : '' }}">
                                {!! Form::label('cancunhapkho_number', 'Số lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancunhapkho_number', $cancunhapkho->cancunhapkho_number, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập số lệnh']) !!}
                                @if ($errors->has('cancunhapkho_number'))
                                    <span class="help-block">{{ $errors->first('cancunhapkho_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                            <button type="button" onclick="app.cancunhapkho.delete({{ $cancunhapkho->cancunhapkho_id }}).then(function(isConfirm) { if (isConfirm) {  window.location = '{{ route('xuatnhap.nhapkho.cancunhapkho.index') }}'; } })" class="btn btn-danger">Xóa</button>
                            <a href="{{ route('xuatnhap.nhapkho.cancunhapkho.index') }}" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#cancunhapkho_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            format: 'DD/MM/YYYY'
        });
    });
</script>
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
    <script src="{{ URL::asset('public/js/cancunhapkho.js') }}"></script>
    <script>
        @if(session('update-cancunhapkho-success'))
            sweetAlert({
                title: "{{ session('update-cancunhapkho-success') }}",
                type: 'success'
            });
        @endif
    </script>
@endsection