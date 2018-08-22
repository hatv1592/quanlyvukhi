@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Thêm vũ khí</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmucvukhi.vukhi.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('covukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('covukhi_id', 'Kích cỡ', ['class' => 'control-label']) !!}
                                    {!! Form::select('covukhi_id', $weaponSizes, null, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('covukhi_id'))
                                        <span class="help-block">{{ $errors->first('covukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_code') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_code', 'Mã', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_code', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã vũ khí']) !!}
                                    @if ($errors->has('vukhi_code'))
                                        <span class="help-block">{{ $errors->first('vukhi_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên vũ khí']) !!}
                                    @if ($errors->has('vukhi_name'))
                                        <span class="help-block">{{ $errors->first('vukhi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_kyhieu') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_kyhieu', 'Ký hiệu', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_kyhieu', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập ký hiệu vũ khí']) !!}
                                    @if ($errors->has('vukhi_kyhieu'))
                                        <span class="help-block">{{ $errors->first('vukhi_kyhieu') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('vukhi_trongluong') ? 'has-error' : '' }}">
                                    {!! Form::label('vukhi_trongluong', 'Trọng lượng', ['class' => 'control-label']) !!}
                                    {!! Form::text('vukhi_trongluong', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập trọng lượng vũ khí']) !!}
                                    @if ($errors->has('vukhi_trongluong'))
                                        <span class="help-block">{{ $errors->first('vukhi_trongluong') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_dai') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_dai', 'Chiều dài', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_dai', '', ['class' => 'form-control', 'placeholder' => 'Chiều dài vũ khí']) !!}
                                            @if ($errors->has('vukhi_dai'))
                                                <span class="help-block">{{ $errors->first('vukhi_dai') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_rong') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_rong', 'Chiều rộng', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_rong', '', ['class' => 'form-control', 'placeholder' => 'Chiều rộng vũ khí']) !!}
                                            @if ($errors->has('vukhi_rong'))
                                                <span class="help-block">{{ $errors->first('vukhi_rong') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('vukhi_cao') ? 'has-error' : '' }}">
                                            {!! Form::label('vukhi_cao', 'Chiều cao', ['class' => 'control-label']) !!}
                                            {!! Form::text('vukhi_cao', '', ['class' => 'form-control', 'placeholder' => 'Chiều cao vũ khí']) !!}
                                            @if ($errors->has('vukhi_cao'))
                                                <span class="help-block">{{ $errors->first('vukhi_cao') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('vukhi_active', null, ['checked']) !!} Trạng thái
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

                <h3 class="text-center text-uppercase">Danh sách vũ khí</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $weapons->total() }}</strong> (vũ khí)</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                            <tr>
                                <th class="text-center width-percent-5">#</th>
                                <th class="text-left">Kích cỡ</th>
                                <th class="text-center">Mã</th>
                                <th class="text-left">Tên</th>
                                <th class="text-center">Ký hiệu</th>
                                <th class="text-center">Trọng lượng</th>
                                <th class="text-center">Chiều dài</th>
                                <th class="text-center">Chiều rộng</th>
                                <th class="text-center">Chiều cao</th>
                                <th class="text-center">Trạng thái</th>
                                @if(\App\User::isUser())
                                    <th class="width-percent-5">Sửa</th>
                                    <th class="width-percent-5">Xóa</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($weapons as $weapon)
                                <tr>
                                    <td class="text-right">{{ $weapon->vukhi_id }}</td>
                                    <td>{{ is_object($weapon->covukhi) ? $weapon->covukhi->covukhi_name : '' }}</td>
                                    <td class="text-center">{{ $weapon->vukhi_code }}</td>
                                    <td class="text-wrap">{{ $weapon->vukhi_name }}</td>
                                    <td class="text-wrap text-center">{{ $weapon->vukhi_kyhieu }}</td>
                                    <td class="text-wrap text-right">{{ $weapon->vukhi_trongluong }}</td>
                                    <td class="text-wrap text-right">{{ $weapon->vukhi_dai }}</td>
                                    <td class="text-wrap text-right">{{ $weapon->vukhi_rong }}</td>
                                    <td class="text-wrap text-right">{{ $weapon->vukhi_cao }}</td>
                                    <td class="text-center">{{ $weapon->vukhi_active }}</td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmucvukhi.vukhi.view', $weapon->vukhi_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs"
                                                    onclick="app.vukhi.delete({{ $weapon->vukhi_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
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
        @if(session('add-vukhi-success'))
            sweetAlert({
            title: "{{ session('add-vukhi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection