@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Thêm nước sản xuất</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmuckhac.nuocsanxuat.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('hevukhi_id') ? 'has-error' : '' }}">
                                    {!! Form::label('hevukhi_id', 'Hệ vũ khí', ['class' => 'control-label']) !!}
                                    {!! Form::select('hevukhi_id', $weaponSystems, null, ['class' => 'form-control select2_single']) !!}
                                    @if ($errors->has('hevukhi_id'))
                                        <span class="help-block">{{ $errors->first('hevukhi_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('nuocsanxuat_name') ? 'has-error' : '' }}">
                                    {!! Form::label('nuocsanxuat_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('nuocsanxuat_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên nước sản xuất']) !!}
                                    @if ($errors->has('nuocsanxuat_name'))
                                        <span class="help-block">{{ $errors->first('nuocsanxuat_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('nuocsanxuat_active', null, ['checked']) !!} Trạng thái
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

                <h3 class="text-center text-uppercase">Danh sách các nước sản xuất</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $countries->total() }}</strong> (nước sản
                            xuất)
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                            <tr>
                                <th class="text-center width-percent-5">#</th>
                                <th class="text-left">Hệ vũ khí</th>
                                <th class="text-left">Tên</th>
                                <th class="text-center width-percent-10">Trạng thái</th>
                                @if(\App\User::isUser())
                                    <th class="width-percent-5">Sửa</th>
                                    <th class="width-percent-5">Xóa</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($countries as $country)
                                <tr>
                                    <td class="text-right">{{ $country->nuocsanxuat_id }}</td>
                                    <td>{{ is_object($country->hevukhi) ? $country->hevukhi->hevukhi_name : '' }}</td>
                                    <td class="text-wrap">{{ $country->nuocsanxuat_name }}</td>
                                    <td class="text-center">{{ $country->nuocsanxuat_active }}</td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmuckhac.nuocsanxuat.view', $country->nuocsanxuat_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs"
                                                    onclick="app.nuocsanxuat.delete({{ $country->nuocsanxuat_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
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
                        {{ $countries->links() }}
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
    <script src="{{ URL::asset('public/js/nuocsanxuat.js') }}"></script>
    <script>
        @if(session('add-nuocsanxuat-success'))
            sweetAlert({
            title: "{{ session('add-nuocsanxuat-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection