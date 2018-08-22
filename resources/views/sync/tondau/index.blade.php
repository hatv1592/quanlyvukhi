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

            </div>
            <div class="x_content">

                <h3 style="text-align:center;text-transform: uppercase">XUẤT DỮ LIỆU TỒN KHO GỬI CẤP TRÊN</h3>
                <div class="x_panel">
                    @if(Session::has('flash_message_success'))
                        <div class="alert alert-success"><span
                                    class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message_success') !!}</em>
                        </div>
                    @endif
                    @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger"><span
                                    class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message_error') !!}</em>
                        </div>
                    @endif
                    @if($errors->has())
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            @foreach ($errors->all() as $error)
                                <p><i class="glyphicon glyphicon-ok"></i>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div>
                        <form action="" class="form-horizontal form-label-left" method="post" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            {{--<div class="form-group">


                                <label for="donvixuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị xuất</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select name="input[donvi_id]"
                                            class="select2_single form-control">
                                        <option selected
                                                value="0">Toàn bộ các đơn vị
                                        </option>
                                        @if(isset($donVi))
                                            @foreach ($donVi as $key => $eachDonVi)
                                                <option @if($key == old('input')['donvi_id']) selected @endif
                                                value="{{$key}}">{{$eachDonVi}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>--}}

                            {{--<div class="form-group">
                                <label for="from_date" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Từ ngày</label>

                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <input
                                            name="input[from_date]" type="text"
                                            class="form-control date"
                                            value="@if(old('input')['from_date']){{old('input')['from_date']}} @endif"
                                            placeholder="">
                                </div>
                                <label for="to_date" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đến ngày</label>

                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <input
                                            name="input[to_date]" type="text"
                                            class="form-control date"
                                            value="@if(old('input')['to_date']){{old('input')['to_date']}} @endif"
                                            placeholder="">
                                </div>
                            </div>--}}

                            <hr>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">Xuất dữ liệu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.date').daterangepicker({
                singleDatePicker: true,
                format: 'DD/MM/YYYY',
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
@endsection