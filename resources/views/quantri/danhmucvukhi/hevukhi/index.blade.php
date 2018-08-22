@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12 hevukhi">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Quản trị hệ vũ khí</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmucvukhi.hevukhi.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('hevukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_code', 'Mã hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('hevukhi_code', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã hệ vũ khí']) !!}
                                    @if ($errors->has('hevukhi_code'))
                                        <span class="help-block">{{ $errors->first('hevukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('hevukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_name', 'Tên hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('hevukhi_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên hệ vũ khí']) !!}
                                    @if ($errors->has('hevukhi_name'))
                                        <span class="help-block">{{ $errors->first('hevukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('hevukhi_active', null, ['checked']) !!} Trạng thái
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <hr>

                <h3 class="text-center text-uppercase">Danh sách hệ vũ khí</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $weapons->total() }}</strong> (hệ vũ khí)</div>
                    </div>
                </div>

                {{-- List of weapons --}}
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                                <tr>
                                    <th class="text-center width-percent-5">#</th>
                                    <th class="text-center width-percent-10">Mã hệ vũ khí</th>
                                    <th class="text-left width-percent-50">Tên hệ vũ khí</th>
                                    <th class="text-center width-percent-10">Trạng thái</th>
                                    @if(\App\User::isUser())
                                        <th class="width-percent-5">Sửa</th>
                                        <th class="width-percent-5">Xóa</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($weapons as $weapon)
                                <tr>
                                    <td class="text-right">{{ $weapon->hevukhi_id }}</td>
                                    <td class="text-right">{{ $weapon->hevukhi_code }}</td>
                                    <td class="text-wrap">{{ $weapon->hevukhi_name }}</td>
                                    <td class="text-center">{{ $weapon->hevukhi_active }}</td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmucvukhi.hevukhi.view', $weapon->hevukhi_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs"
                                                    onclick="app.hevukhi.delete({{ $weapon->hevukhi_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
                                                <i class="fa fa-close"></i></button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="row">
                    <div class="col-md-12">
                        {{ $weapons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extension.style')
    <link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="{{URL::asset('public/css/common.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/css/hevukhi.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script src="{{ URL::asset('public/js/hevukhi.js') }}"></script>
    <script>
        @if(session('add-hevukhi-success'))
            sweetAlert({
            title: "{{ session('add-hevukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection