@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    <h3 class="text-uppercase text-center">Thêm đơn vị tính</h3>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(['url' => route('quantri.danhmuckhac.donvitinh.create'), 'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group {{ $errors->has('donvitinh_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvitinh_name', 'Tên', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvitinh_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên đơn vị tính']) !!}
                                    @if ($errors->has('donvitinh_name'))
                                        <span class="help-block">{{ $errors->first('donvitinh_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('donvitinh_active', null, ['checked']) !!} Trạng thái
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

                <h3 class="text-center text-uppercase">Danh sách đơn vị tính</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">Tổng số: <strong>{{ $calculationUnit->total() }}</strong> (đơn vị tính)
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom">
                            <thead>
                                <tr>
                                    <th class="text-center width-percent-5">#</th>
                                    <th class="text-left">Tên</th>
                                    <th class="text-center width-percent-10">Trạng thái</th>
                                    @if(\App\User::isUser())
                                        <th class="width-percent-5">Sửa</th>
                                        <th class="width-percent-5">Xóa</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($calculationUnit as $itemCalculationUnit)
                                <tr>
                                    <td class="text-right">{{ $itemCalculationUnit->donvitinh_id }}</td>
                                    <td class="text-wrap">{{ $itemCalculationUnit->donvitinh_name }}</td>
                                    <td class="text-center">{{ $itemCalculationUnit->donvitinh_active }}</td>
                                    @if(\App\User::isUser())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{ route('quantri.danhmuckhac.donvitinh.view', $itemCalculationUnit->donvitinh_id) }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs"
                                                    onclick="app.donvitinh.delete({{ $itemCalculationUnit->donvitinh_id }}).then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
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
                        {{ $calculationUnit->links() }}
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
    <script src="{{ URL::asset('public/js/donvitinh.js') }}"></script>
    <script>
        @if(session('add-donvitinh-success'))
            sweetAlert({
            title: "{{ session('add-donvitinh-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection