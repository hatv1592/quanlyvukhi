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
                <h3 class="text-uppercase">Thêm căn cứ nhập kho</h3>

                {!! Form::open(['url' => route('xuatnhap.nhapkho.cancunhapkho.create'), 'class' => 'form-horizontal form-label-left']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cancunhapkho_name') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_name', 'Tên căn cứ nhập kho', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên căn cứ nhập kho']) !!}
                            @if ($errors->has('cancunhapkho_name'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancunhapkho_date') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_date', 'Ngày nhận lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_date', null, ['class' => 'form-control date-picker', 'id' => 'cancunhapkho_date', 'placeholder' => 'Vui lòng nhập ngày nhận lệnh']) !!}
                            @if ($errors->has('cancunhapkho_date'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_date') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancunhapkho_note') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_note', 'Ghi chú', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_note', null, ['class' => 'form-control', 'placeholder' => 'Ghi chú', 'size' => '20x5']) !!}
                            @if ($errors->has('cancunhapkho_note'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_note') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('cancunhapkho_active', null, ['checked']) !!} Trạng thái
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cancunhapkho_coquan') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_coquan', 'Tên cơ quan ra lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_coquan', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cơ quan ra lệnh']) !!}
                            @if ($errors->has('cancunhapkho_coquan'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_coquan') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancunhapkho_code') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_code', 'Mã lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_code', null, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã lệnh']) !!}
                            @if ($errors->has('cancunhapkho_code'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_code') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancunhapkho_number') ? 'has-error' : '' }}">
                            {!! Form::label('cancunhapkho_number', 'Số lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancunhapkho_number', null, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập số lệnh']) !!}
                            @if ($errors->has('cancunhapkho_number'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_number') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('xuatnhap.nhapkho.phieunhapkho.index') }}" class="btn btn-warning">Thoát</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <hr>

            <h3 class="text-center text-uppercase">Danh sách căn cứ nhập kho</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">Tổng số: <strong>{{ $danhsachCancunhapkho->total() }}</strong> (căn cứ nhập kho)</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-custom">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Tên căn cứ nhập kho</th>
                                <th class="text-left">Tên cơ quan ra lệnh</th>
                                <th class="text-left">Mã lệnh</th>
                                <th class="text-left">Số lệnh</th>
                                <th class="text-left">Ngày lệnh</th>
                                <th class="text-center">Ghi chú</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="width-percent-5">Sửa</th>
                                <th class="width-percent-5">Xóa</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($danhsachCancunhapkho as $cancunhapkho)
                            <tr>
                                <td>{{ $cancunhapkho->cancunhapkho_id }}</td>
                                <td class="text-wrap">{{ $cancunhapkho->cancunhapkho_name }}</td>
                                <td class="text-wrap">{{ $cancunhapkho->cancunhapkho_coquan }}</td>
                                <td>{{ $cancunhapkho->cancunhapkho_code }}</td>
                                <td>{{ $cancunhapkho->cancunhapkho_number }}</td>
                                <td class="text-left">{{ $cancunhapkho->cancunhapkho_date }}</td>
                                <td class="text-wrap text-center">{{ $cancunhapkho->cancunhapkho_note }}</td>
                                <td class="text-center">@if($cancunhapkho->cancunhapkho_active  == 1) Hiển thị @else Ẩn @endif </td>
                                <td class="text-center">
                                    <a title="Sửa" href="{{ route('xuatnhap.nhapkho.cancunhapkho.view', $cancunhapkho->cancunhapkho_id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <button title="Xóa" class="btn btn-danger btn-xs" onclick="app.cancunhapkho.delete({{ $cancunhapkho->cancunhapkho_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="row">
                <div class="col-md-12">
                    {{ $danhsachCancunhapkho->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#cancunhapkho_date').daterangepicker({
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
    <script src="{{ URL::asset('public/js/cancunhapkho.js') }}"></script>

    <script>
        @if(session('add-cancunhapkho-success'))
            sweetAlert({
            title: "{{ session('add-cancunhapkho-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection