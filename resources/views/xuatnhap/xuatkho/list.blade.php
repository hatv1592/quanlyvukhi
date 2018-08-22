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
        {{--<div class="x_panel">--}}
        {{--<div class="x_title">--}}
        {{--<a href="{{route('xuatnhap.xuatkho.cancuxuatkho.index')}}" class="btn btn-sm btn-info">--}}
        {{--<span style="color: #fff; text-tra">Nhập căn cứ xuất kho</span>--}}
        {{--</a>--}}
        {{--<a href="{{route('xuatnhap.phieuxuatkho.create')}}" class="btn btn-sm btn-info">--}}
        {{--<span style="color: #fff">Tạo phiếu xuất kho</span>--}}
        {{--</a>--}}

        {{--<div class="clearfix"></div>--}}
        {{--</div>--}}
        <div class="x_content">
            <h3 style="text-align:center;text-transform: uppercase">Danh sách lệnh xuất kho
                <a href="{{route('xuatnhap.xuatkho.cancuxuatkho.index')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff; text-tra">Nhập căn cứ xuất kho</span>
                </a>
                <a href="{{route('xuatnhap.phieuxuatkho.create')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff">Tạo phiếu xuất kho</span>
                </a>
            </h3>

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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_content">
                        <table class="table table-bordered text-center" id="">
                            <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                            <thead style="text-align: center">
                            <tr>
                                <th rowspan="2">STT</th>
                                <th rowspan="2">Số lệnh</th>
                                <th rowspan="2">Căn cứ xuất</th>
                                <th rowspan="2">Ngày tạo</th>
                                <th rowspan="2">Đơn vị xuất</th>
                                <th rowspan="2">Đơn vị nhập</th>
                                <th rowspan="2">Trạng thái</th>
                                <th rowspan="2">In phiếu</th>
                                @if(\App\User::isSuperAdmin())
                                    <th colspan="2">Admin</th>
                                @endif
                            </tr>
                            <tr>
                                @if(\App\User::isSuperAdmin())
                                    <th class="text-center">Sửa</th>
                                    <th class="text-center">Xóa</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $stt = 0;
                            foreach ($phieu_xuat_kho as $each_phieu_xuat_kho) {
                            ?>
                            <tr>
                                <td> <?php echo ++$stt; ?></td>
                                <td> <?php echo $each_phieu_xuat_kho->pxk_sophieu ?></td>
                                <td> {{$each_phieu_xuat_kho->Cancuxuatkho->cancuxuatkho_name}}</td>
                                <td> <?php echo $each_phieu_xuat_kho->pxk_ngay_tao ?></td>
                                <td> {{isset($each_phieu_xuat_kho->DonviXuat->donvi_name)?($each_phieu_xuat_kho->DonviXuat->donvi_name):''}}</td>
                                <td> {{$each_phieu_xuat_kho->donvinhap_name}}</td>
                                <td> <?php
                                    if ($each_phieu_xuat_kho->pxk_status >= 1) {
                                        $status = \App\Model\Xuatnhap\PhieuxuatkhoModel::pxk_status();
                                        echo $status[$each_phieu_xuat_kho->pxk_status];
                                    } else {
                                        if (\App\User::isUser()) {
                                            echo '<a class="btn btn-info btn-xs"
                                                href="' . route('xuatnhap.phieuxuatkho.confirm', ['id' => $each_phieu_xuat_kho->pxk_id]) . '">Cập nhật</a>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a target="_blank"
                                       href="{{route('xuatnhap.inphieuxuatkho', $each_phieu_xuat_kho->pxk_id)}}"
                                       class="btn btn-info btn-xs">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                @if(\App\User::isSuperAdmin())
                                    <td>
                                        @if ($each_phieu_xuat_kho->pxk_status <= 1)
                                            @if ($each_phieu_xuat_kho->pxk_status <= 1)
                                                <a class="btn btn-info btn-xs"
                                                   href="{{route('xuatnhap.phieuxuatkho.admin_confirm', ['id' => $each_phieu_xuat_kho->pxk_id])}}">Hoàn thiện</a>
                                            @else
                                                Chưa thực hiện
                                            @endif
                                        @else
                                            Không sửa
                                        @endif
                                    </td>
                                    <td>

                                        @if ($each_phieu_xuat_kho->pxk_status <= 1)
                                            <a
                                                    href="javascript:void(0)"
                                                    onclick="if(confirm('Bạn chắc chắn xóa phiếu xuất kho, việc này không thể khôi phục. Hãy cẩn trọng.')) { location.href='{{route('xuatnhap.phieuxuatkho.admin_delete', ['id' => $each_phieu_xuat_kho->pxk_id])}}';}"
                                                    class="btn btn-info btn-xs btn-danger"> <i
                                                        class="fa fa-close"></i></a>
                                        @else
                                            Không xóa
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        {{$phieu_xuat_kho->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            $('select.form-control').on('change', function () {
                var target_table_value = $(this).val();
                var target_table = $(this).attr('target-table');
                var update = $(this).attr('update');
                if (target_table_value != 'undefined' && target_table != 'undefined' && update != 'undefined')
                    $.ajax({
                        url: '{{ url("/tonkho/gettableoption/")}}',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            "target_table_value": target_table_value,
                            "target_table": target_table,
                            "update": update
                        },
                        beforeSend: function (xhr) {
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.code == 200) {
                                $("#" + update).html(data.html);
                            }
                            if (target_table == 'hevukhi') {
                                $("#nuocsanxuat").html(data.html_nsx);
                            }
                        }
                    });
            });
        });

        var app = app || {};

        (function (app) {
            app.phieuxuatkho = {
                delete: function (id) {
                    return app.dialog.confirmDelete().then(function () {
                        $(location).attr('href', '/xuatnhap/phieuxuatkho/delete/' + id);
                    });
                }
            };
        })(app);

    </script>
@endsection