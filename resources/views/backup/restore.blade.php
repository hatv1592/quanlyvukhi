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
            <div class="x_content">
                <h3 style="text-align:center;text-transform: uppercase">Hệ thống phục hồi dữ liệu</h3>

                <div class="x_panel">
                    <div>
                        <form onsubmit="return confirm('Bạn muốn backup lại dữ liệu hệ thống?');"
                              class="form-horizontal form-label-left"
                              action="{{route('backup.restore')}} "
                              method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="ln_solid"></div>


                            @if($is_backup)

                                <div class=""
                                     style="width: 50%; min-width: 200px; padding: 5px; margin: auto; text-align: center">
                                    <span class="ace-icon fa fa-check bigger-110 green"></span> File backup đã tồn tại
                                </div>
                            @elseif(!$is_backup)
                                <div class=""
                                     style="width: 50%; min-width: 200px; padding: 5px; margin: auto; text-align: center">
                                    <span class="ace-icon fa fa-check bigger-110 red"></span> Không tồn tại file backup
                                    đã tồn tại
                                </div>
                            @endif
                            @if($errors->has())
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <p><i class="glyphicon glyphicon-ok"></i>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="text-center">
                                    @if(!$is_backup)
                                        <button disabled type="submit" class="btn btn-round btn-primary"
                                                style="width: 150px"
                                                onclick="nodata()">
                                            Backup lại dữ liệu cũ
                                        </button>
                                    @elseif(    $is_backup)
                                        <button tyFpe="submit" class="btn btn-round btn-primary"
                                                style="width: 150px"
                                                onclick="nodata()">
                                            Backup lại dữ liệu cũ
                                        </button>
                                    @endif
                                    {{--<button class="btn btn-round btn-danger" style="width: 150px">Thoát</button>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection