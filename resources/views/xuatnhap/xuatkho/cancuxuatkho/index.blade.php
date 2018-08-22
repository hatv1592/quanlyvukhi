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
                <h3 class="text-uppercase">Thêm căn cứ xuất kho</h3>

                {!! Form::open(['url' => route('xuatnhap.xuatkho.cancuxuatkho.create'), 'class' => 'form-horizontal form-label-left']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cancuxuatkho_name') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_name', 'Tên căn cứ xuất kho', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên căn cứ xuất kho']) !!}
                            @if ($errors->has('cancuxuatkho_name'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancuxuatkho_date') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_date', 'Ngày nhận lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_date', null, ['class' => 'form-control date-picker', 'id' => 'cancuxuatkho_date', 'placeholder' => 'Vui lòng nhập ngày nhận lệnh']) !!}
                            @if ($errors->has('cancuxuatkho_date'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_date') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancuxuatkho_note') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_note', 'Ghi chú', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_note', null, ['class' => 'form-control', 'placeholder' => 'Ghi chú', 'size' => '20x5']) !!}
                            @if ($errors->has('cancuxuatkho_note'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_note') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('cancuxuatkho_active', null, ['checked']) !!} Trạng thái
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cancuxuatkho_cqralenh') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_cqralenh', 'Tên cơ quan ra lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_cqralenh', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cơ quan ra lệnh']) !!}
                            @if ($errors->has('cancuxuatkho_cqralenh'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_cqralenh') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancuxuatkho_code') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_code', 'Mã lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_code', null, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã lệnh']) !!}
                            @if ($errors->has('cancuxuatkho_code'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_code') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cancuxuatkho_number') ? 'has-error' : '' }}">
                            {!! Form::label('cancuxuatkho_number', 'Số lệnh', ['class' => 'control-label']) !!}
                            {!! Form::text('cancuxuatkho_number', null, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập số lệnh']) !!}
                            @if ($errors->has('cancuxuatkho_number'))
                                <span class="help-block">{{ $errors->first('cancuxuatkho_number') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                        <a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-warning">Thoát</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <hr>

            <h3 class="text-center text-uppercase">Danh sách căn cứ xuất kho</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">Tổng số: <strong>{{ $danhsachCancuxuatkho->total() }}</strong> (căn cứ xuất kho)</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-custom">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Tên căn cứ xuất kho</th>
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
                        @foreach ($danhsachCancuxuatkho as $cancuxuatkho)
                            <tr>
                                <td>{{ $cancuxuatkho->cancuxuatkho_id }}</td>
                                <td class="text-wrap">{{ $cancuxuatkho->cancuxuatkho_name }}</td>
                                <td class="text-wrap">{{ $cancuxuatkho->cancuxuatkho_cqralenh }}</td>
                                <td>{{ $cancuxuatkho->cancuxuatkho_code }}</td>
                                <td>{{ $cancuxuatkho->cancuxuatkho_number }}</td>
                                <td>{{ $cancuxuatkho->cancuxuatkho_date }}</td>
                                <td class="text-wrap">{{ $cancuxuatkho->cancuxuatkho_note }}</td>
                                <td class="text-center">@if($cancuxuatkho->cancuxuatkho_active  == 1) Hiển thị @else Ẩn @endif </td>
                                <td class="text-center">
                                    <a title="Sửa" href="{{ route('xuatnhap.xuatkho.cancuxuatkho.view', $cancuxuatkho->cancuxuatkho_id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <button title="Xóa" class="btn btn-danger btn-xs" onclick="app.cancuxuatkho.delete({{ $cancuxuatkho->cancuxuatkho_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })"><i class="fa fa-close"></i></button>
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
                    {{ $danhsachCancuxuatkho->links() }}
                </div>
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
        @if(session('add-cancuxuatkho-success'))
            sweetAlert({
            title: "{{ session('add-cancuxuatkho-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection