@extends('../master')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12 hevukhi">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản trị hệ vũ khí</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            {{-- TODO: Move this style to css file --}}


            <div class="x_panel">
                <h3 class="text-uppercase">Thêm hệ vũ khí</h3>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['url' => route('quantri.danhmucvukhi.hevukhi.create'), 'class' => 'form-horizontal form-label-left']) !!}
                            <div class="form-group {{ $errors->has('hevukhi_code') ? 'has-error' : '' }}">
                                {!! Form::label('hevukhi_code', 'Mã hệ vũ khí', ['class' => 'control-label']) !!}
                                {!! Form::text('hevukhi_code', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mã hệ vũ khí']) !!}
                                @if ($errors->has('hevukhi_code'))
                                <span class="help-block">{{ $errors->first('hevukhi_code') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('hevukhi_name') ? 'has-error' : '' }}"">
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

                            {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
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
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">#</th>
                                    <th class="text-left">Mã hệ vũ khí</th>
                                    <th class="text-left width-percent-50">Tên hệ vũ khí</th>
                                    <th class="text-left">Trạng thái</th>
                                    <th class="width-percent-5">Sửa</th>
                                    <th class="width-percent-5">Xóa</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($weapons as $weapon)
                                    <tr>
                                        <td>{{ $weapon->hevukhi_id }}</td>
                                        <td>{{ $weapon->hevukhi_code }}</td>
                                        <td class="text-wrap">{{ $weapon->hevukhi_name }}</td>
                                        <td>{{ $weapon->hevukhi_active }}</td>
                                        <td class="text-center">
                                            <a title="Sửa" href="{{route('quantri.danhmucvukhi.suahevukhi')}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button title="Xóa" class="btn btn-danger btn-xs" onclick="confirmDelete({{ $weapon->hevukhi_id }})"><i class="fa fa-close"></i></button>
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
                        {{ $weapons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{csrf_token()}};
@endsection

@section('extension.style')
<link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
<link href="{{URL::asset('public/css/hevukhi.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
<script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
<script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

<script>
    function confirmDelete(id) {
        sweetAlert({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            $.ajax({
                url: '{{ url('quantri/danhmucvukhi/hevukhi') }}' + '/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    sweetAlert({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        type: 'success'
                    }).then(function () {
                        window.location.reload();
                    });
                },
                error: function(error) {
                    sweetAlert({
                        title: 'Delete was fails!',
                        type: 'error'
                    });
                }
            });
        });
    }

    {{----}}
    {{--var apiCall = function(url, method) {--}}
        {{--return new Promise(function(resolve, reject) {--}}
            {{--$.ajax({--}}
                {{--url: url,--}}
                {{--type: method,--}}
                {{--data: {--}}
                    {{--_token: '{{ csrf_token() }}'--}}
                {{--},--}}
                {{--success: function(result) {--}}
                    {{--resolve(result);--}}
                {{--},--}}
                {{--error: function(error) {--}}
                    {{--reject(error);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--};--}}

    {{--apiCall('{{ url('quantri/danhmucvukhi/hevukhi') }}' + '/' + 333, 'POST').then(function() {--}}
        {{--console.log(arguments);--}}
    {{--}).catch(function(error) {--}}
        {{--console.log(error);--}}
    {{--});--}}

    @if(Session::has('add-hevukhi-success'))
        sweetAlert({
            title: "{{ Session::get('add-hevukhi-success') }}",
            type: 'success'
        });
    @endif
</script>
@endsection