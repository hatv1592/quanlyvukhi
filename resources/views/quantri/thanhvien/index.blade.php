@extends('../master')

@section('extension.style')
    <link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="{{URL::asset('public/css/common.css')}}" rel="stylesheet">
@endsection

@section('extension.js')
    <script src="/node_modules/sweetalert2/node_modules/es6-promise/dist/es6-promise.min.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ URL::asset('public/js/api.js') }}"></script>
    <script src="{{ URL::asset('public/js/dialog.js') }}"></script>
    <script>
        @if(session('flash_message_success'))
            sweetAlert({
            title: "{{ session('flash_message_success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection
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
                    <h3 class="text-uppercase">Thêm thành viên</h3>

                    {!! Form::open(['url' => route('quantri.quantringuoidung.user.create'), 'class' => 'form-horizontal form-label-left']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                {!! Form::label('user_name', 'Tên thành viên', ['class' => 'control-label']) !!}
                                {!! Form::text('user_name', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên thành viên']) !!}
                                @if ($errors->has('user_name'))
                                    <span class="help-block">{{ $errors->first('user_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_email') ? 'has-error' : '' }}">
                                {!! Form::label('user_email', 'Email thành viên (Tên đăng nhập)', ['class' => 'control-label']) !!}
                                {!! Form::text('user_email', '', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên thành viên']) !!}
                                @if ($errors->has('user_email'))
                                    <span class="help-block">{{ $errors->first('user_email') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_password') ? 'has-error' : '' }}">
                                {!! Form::label('user_password', 'Mật khẩu', ['class' => 'control-label']) !!}
                                {!! Form::password('user_password', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mật khẩu']) !!}
                                @if ($errors->has('user_password'))
                                    <span class="help-block">{{ $errors->first('user_password') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_password_re') ? 'has-error' : '' }}">
                                {!! Form::label('user_password_re', 'Nhập lại mật khẩu', ['class' => 'control-label']) !!}
                                {!! Form::password('user_password_re',['class' => 'form-control', 'placeholder' => 'Vui lòng nhập lại mật khẩu']) !!}
                                @if ($errors->has('user_password_re'))
                                    <span class="help-block">{{ $errors->first('user_password_re') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                @if(count($roles)>0)
                                    {!! Form::label('role', 'Quyền thành viên', ['class' => 'control-label']) !!}
                                    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('user_active', null, ['checked']) !!} Trạng thái
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <h4 class="green">Ghi chú</h4>
                                <p>
                                    Có 3 loai quyền:
                                </p>
                                <ul>
                                    <li><b>Full quyền</b>: Thành viên có tất cả các quyền thêm sủa xóa....</li>
                                    <li><b>Thành viên</b>: Thêm vũ khí, đối soát</li>
                                    <li><b>Chỉ xem</b>: Chỉ có quyền xem</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                            {{--<a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-warning">Thoát</a>--}}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                <hr>

                <h3 class="text-center text-uppercase">Danh sách thành viên</h3>

                <div class="row">
                    <div class="col-md-12">
                        {{--<div class="form-group">Tổng số: <strong>x</strong> (Thành viên)</div>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-custom text-center">
                            <thead>
                            <tr>
                                <th rowspan="2" class="text-left">#</th>
                                <th rowspan="2" class="text-left">Tên thành viên</th>
                                <th rowspan="2">Email (Tài khoản)</th>
                                <th colspan="{{count($roles)}}" class="text-center">Quyền thành viên</th>
                                @if(\App\User::isSuperAdmin())
                                    <th rowspan="2" class="width-percent-5">Sửa</th>
                                    <th rowspan="2" class="width-percent-5">Xóa</th>
                                @endif
                            </tr>
                            <tr>
                                @foreach($roles as $role)
                                    <th>{{$role}}</th>
                                @endforeach

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @foreach($roles as $key => $role)
                                        <td>
                                            <i class="<?php echo ($key == $user->role) ? 'fa fa-check green' : 'fa fa-close' ?>"></i>
                                        </td>
                                    @endforeach

                                    {{--<td class="text-center">--}}
                                    {{--<a title="Sửa" href="{{route('quantri.quantringuoidung.user.view',$user->id)}}"--}}
                                    {{--class="btn btn-info btn-xs"><i--}}
                                    {{--class="fa fa-edit"></i></a>--}}
                                    {{--</td>--}}
                                    @if(\App\User::isSuperAdmin())
                                        <td class="text-center">
                                            <a title="Sửa"
                                               href="{{route('quantri.quantringuoidung.user.view',$user->id)}}"
                                               class="btn btn-info btn-xs"><i
                                                        class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <a
                                                    href="javascript:void(0)"
                                                    onclick="app.quantringuoidung.delete({{$user->id}}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('quantri.quantringuoidung.user.index') }}'; }})"
                                                    class="btn btn-info btn-xs btn-danger"> <i
                                                        class="fa fa-close"></i>
                                            </a>
                                            {{--<button title="Xóa" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>--}}
                                            {{--</button>--}}
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
                        {{$users->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var app = app || {};

        (function (app) {
            app.quantringuoidung = {
                delete: function (id) {
                    return app.dialog.confirmDelete().then(function () {
                        $(location).attr('href', '/quantri/quantringuoidung/thanhvien/delete/' + id);
                    });
                }
            };
        })(app);
        $(document).ready(function () {
            $('#user_date').daterangepicker({
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