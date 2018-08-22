@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Quản trị cỡ vũ khí</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmucvukhi.covukhi.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('nhomvukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('nhomvukhi_id', 'Nhóm vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::select('nhomvukhi_id', $weaponGroups, null, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('nhomvukhi_id'))
                                        <span class="help-block">{{ $errors->first('nhomvukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('covukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_code', 'Mã cỡ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('covukhi_code', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã cỡ vũ khí']) !!}
                                    @if ($errors->has('covukhi_code'))
                                        <span class="help-block">{{ $errors->first('covukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('covukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_name', 'Tên cỡ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::text('covukhi_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên cỡ vũ khí']) !!}
                                    @if ($errors->has('covukhi_name'))
                                        <span class="help-block">{{ $errors->first('covukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('covukhi_active', null, ['checked']) !!} Trạng thái
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

                <h3 class="text-center text-uppercase">Danh sách cỡ vũ khí</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $weaponSizes->total() }}</strong> (cỡ vũ khí)</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                                <tr>
                                    <th class="text-center width-percent-5">#</th>
                                    <th class="text-left">Nhóm vũ khí</th>
                                    <th class="text-center width-percent-15">Mã cỡ vũ khí</th>
                                    <th class="text-left">Tên cỡ vũ khí</th>
                                    <th class="text-center width-percent-10">Trạng thái</th>
                                    @if(\App\User::isUser())
                                        <th class="width-percent-5">Sửa</th>
                                        <th class="width-percent-5">Xóa</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($weaponSizes as $weaponSize)
                                <tr>
                                    <td class="text-right">{{ $weaponSize->covukhi_id }}</td>
                                    <td>{{ is_object($weaponSize->nhomvukhi) ? $weaponSize->nhomvukhi->nhomvukhi_name : '' }}</td>
                                    <td class="text-right">{{ $weaponSize->covukhi_code }}</td>
                                    <td class="text-wrap">{{ $weaponSize->covukhi_name }}</td>
                                    <td class="text-center">{{ $weaponSize->covukhi_active }}</td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmucvukhi.covukhi.view', $weaponSize->covukhi_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs"
                                                    onclick="app.covukhi.delete({{ $weaponSize->covukhi_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
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
                        {{ $weaponSizes->links() }}
                    </div>
                </div>
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
        @if(session('add-covukhi-success'))
            sweetAlert({
            title: "{{ session('add-covukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection