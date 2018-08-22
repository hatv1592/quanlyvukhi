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

                    {!! Form::open(['url' => route('quantri.quantringuoidung.user.update',$user->id), 'class' => 'form-horizontal form-label-left']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                {!! Form::label('user_name', 'Tên thành viên', ['class' => 'control-label']) !!}
                                {!! Form::text('user_name',$user->name, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên thành viên']) !!}
                                @if ($errors->has('user_name'))
                                    <span class="help-block">{{ $errors->first('user_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_email') ? 'has-error' : '' }}">
                                {!! Form::label('user_email', 'Email thành viên (Tên đăng nhập)', ['class' => 'control-label']) !!}
                                {!! Form::text('user_email', $user->email, ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên thành viên']) !!}
                                @if ($errors->has('user_email'))
                                    <span class="help-block">{{ $errors->first('user_email') }}</span>
                                @endif
                            </div>
                            {{--<div class="form-group {{ $errors->has('user_password') ? 'has-error' : '' }}">--}}
                            {{--{!! Form::label('user_password', 'Mật khẩu', ['class' => 'control-label']) !!}--}}
                            {{--{!! Form::password('user_password', ['class' => 'form-control', 'placeholder' => 'Vui lòng nhập mật khẩu']) !!}--}}
                            {{--@if ($errors->has('user_password'))--}}
                            {{--<span class="help-block">{{ $errors->first('user_password') }}</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="form-group {{ $errors->has('user_password_re') ? 'has-error' : '' }}">--}}
                            {{--{!! Form::label('user_password_re', 'Nhập lại mật khẩu', ['class' => 'control-label']) !!}--}}
                            {{--{!! Form::password('user_password_re',['class' => 'form-control', 'placeholder' => 'Vui lòng nhập lại mật khẩu']) !!}--}}
                            {{--@if ($errors->has('user_password_re'))--}}
                            {{--<span class="help-block">{{ $errors->first('user_password_re') }}</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <div class="form-group">
                                @if(count($roles)>0)
                                    {!! Form::label('role', 'Quyền thành viên', ['class' => 'control-label']) !!}
                                    {!! Form::select('role', $roles, $user->role, ['class' => 'form-control']) !!}
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
                            {{--@if(Session::has('flash_message_success'))--}}
                            {{--<div class=""--}}
                            {{--style="width: 50%; min-width: 200px; padding: 5px; margin: auto; text-align: center"><span--}}
                            {{--class="ace-icon fa fa-check bigger-110 green"></span>{!! session('flash_message_success') !!}--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            {{--@if(Session::has('flash_message_error'))--}}
                            {{--<div class="alert alert-danger"><span--}}
                            {{--class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message_error') !!}</em>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            {{--@if($errors->has())--}}
                            {{--<div class="alert alert-danger alert-dismissible fade in" role="alert">--}}
                            {{--@foreach ($errors->all() as $error)--}}
                            {{--<p><i class="glyphicon glyphicon-ok"></i>{{ $error }}</p>--}}
                            {{--@endforeach--}}
                            {{--</div>--}}
                            {{--@endif--}}
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
{{--                            <a href="{{url('/xuatnhap/dsxuatkho')}}" class="btn btn-warning">Thoát</a>--}}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <hr>
                {{-- Pagination --}}
            </div>
        </div>
    </div>
    <script>

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