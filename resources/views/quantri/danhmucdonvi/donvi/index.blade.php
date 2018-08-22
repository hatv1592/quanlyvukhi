@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Thêm đơn vị</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmucdonvi.donvi.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('donvi_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvi_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvi_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên đơn vị']) !!}
                                    @if ($errors->has('donvi_name'))
                                        <span class="help-block">{{ $errors->first('donvi_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('donvi_short_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvi_short_name', 'Mô tả', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvi_short_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên viết tắt']) !!}
                                    @if ($errors->has('donvi_short_name'))
                                        <span class="help-block">{{ $errors->first('donvi_short_name') }}</span>
                                    @endif
                                </div>

                                @if (empty($parentIdDonvi))
                                    <div style="display: none" class="form-group {{ $errors->has('donvi_parent') ? 'has-error' : '' }}">
                                        {!! Form::label('donvi_parent', 'Đơn vị cha', ['class' => 'control-label']) !!}
                                        {!! Form::select('donvi_parent', $parentUnits, null, ['class' => 'form-control select2_single']) !!}
                                        @if ($errors->has('donvi_parent'))
                                            <span class="help-block">{{ $errors->first('donvi_parent') }}</span>
                                        @endif
                                    </div>
                                @endif

                                {!! Form::hidden('donvi_vitri', empty($parentIdDonvi) ? 1 : 2) !!}
                                <div class="form-group text-center" >
                                    {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <hr>

                <h3 class="text-center text-uppercase">Danh sách các đơn vị</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $units->total() }}</strong> (đơn vị)</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                            <tr>
                                <th class="text-left width-percent-10">#</th>
                                <th class="text-left">Tên</th>
                                <th class="text-left">Mô tả</th>
                                <th class="text-left">Thực lực đơn vị</th>
                                {{--<th class="text-left">Đơn vị quản lý</th>--}}
                                @if(\App\User::isUser())
                                    <th class="width-percent-5">Sửa</th>
                                    <th class="width-percent-5">Xóa</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $unit->donvi_id }}</td>
                                    <td class="text-wrap">{{ $unit->donvi_name }}</td>
                                    <td class="text-wrap">{{ $unit->donvi_short_name }}</td>
                                    <td>
                                        <a title="detail"
                                           href="{{ route('quantri.danhmucdonvi.donvi.detail', $unit->donvi_id) }}"
                                           class="" style="color: red">Chi tiêt</a>
                                    </td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmucdonvi.donvi.view', $unit->donvi_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs" onclick="app.donvi.delete({{ $unit->donvi_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })"><i class="fa fa-close"></i></button>
                                            {{--<button title="Xóa" class="btn btn-danger btn-xs"--}}
                                                    {{--onclick="alert('Bạn không có quyền xóa đơn vị')"><i--}}
                                                        {{--class="fa fa-close"></i></button>--}}
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
                        {{ $units->links() }}
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
    <script src="{{ URL::asset('public/js/donvi.js') }}"></script>
    <script>
        @if(session('add-donvi-success'))
            sweetAlert({
            title: "{{ session('add-donvi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection