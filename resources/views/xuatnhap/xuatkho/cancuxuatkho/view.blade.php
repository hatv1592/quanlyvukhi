@extends('../master')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Căn cứ xuất kho</h2>
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
                            <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy căn cứ xuất kho với ID = {{ $id  }}</h3>
                            <a href="{{ route('xuatnhap.xuatkho.cancuxuatkho.index') }}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                @else
                    <h3 class="text-uppercase">Sửa căn cứ xuất kho</h3>

                    {!! Form::open(['url' => route('xuatnhap.xuatkho.cancuxuatkho.update', $cancuxuatkho->cancuxuatkho_id), 'class' => 'form-horizontal form-label-left']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('cancuxuatkho_name') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_name', 'Tên căn cứ xuất kho', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_name', $cancuxuatkho->cancuxuatkho_name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên căn cứ xuất kho']) !!}
                                @if ($errors->has('cancuxuatkho_name'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancuxuatkho_date') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_date', 'Ngày nhận lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_date', date('d-m-Y', strtotime($cancuxuatkho->cancuxuatkho_date)), ['class' => 'form-control date-picker', 'id' => 'cancuxuatkho_date', 'placeholder' => 'Vui lòng nhập ngày nhận lệnh']) !!}
                                @if ($errors->has('cancuxuatkho_date'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancuxuatkho_note') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_note', 'Ghi chú', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_note', $cancuxuatkho->cancuxuatkho_note, ['class' => 'form-control', 'placeholder' => 'Ghi chú', 'size' => '20x5']) !!}
                                @if ($errors->has('cancuxuatkho_note'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_note') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('cancuxuatkho_active', null, $cancuxuatkho->cancuxuatkho_active === 1 ? ['checked'] : []) !!} Trạng thái
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('cancuxuatkho_cqralenh') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_cqralenh', 'Tên cơ quan ra lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_cqralenh', $cancuxuatkho->cancuxuatkho_cqralenh, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cơ quan ra lệnh']) !!}
                                @if ($errors->has('cancuxuatkho_cqralenh'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_cqralenh') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancuxuatkho_code') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_code', 'Mã lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_code', $cancuxuatkho->cancuxuatkho_code, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã lệnh']) !!}
                                @if ($errors->has('cancuxuatkho_code'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_code') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cancuxuatkho_number') ? 'has-error' : '' }}">
                                {!! Form::label('cancuxuatkho_number', 'Số lệnh', ['class' => 'control-label']) !!}
                                {!! Form::text('cancuxuatkho_number', $cancuxuatkho->cancuxuatkho_number, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập số lệnh']) !!}
                                @if ($errors->has('cancuxuatkho_number'))
                                    <span class="help-block">{{ $errors->first('cancuxuatkho_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}
                            <button type="button" onclick="app.cancuxuatkho.delete({{ $cancuxuatkho->cancuxuatkho_id }}).then(function(isConfirm) { if (isConfirm) {  window.location = '{{ route('xuatnhap.xuatkho.cancuxuatkho.index') }}'; } })" class="btn btn-danger">Xóa</button>
                            <a href="{{ route('xuatnhap.xuatkho.cancuxuatkho.index') }}" class="btn btn-warning">Quay lại</a>
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
        $('#cancuxuatkho_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            format: 'DD-MM-YYYY'
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
    <script src="{{ URL::asset('public/js/cancuxuatkho.js') }}"></script>
    <script>
        @if(session('update-cancuxuatkho-success'))
            sweetAlert({
            title: "{{ session('update-cancuxuatkho-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection