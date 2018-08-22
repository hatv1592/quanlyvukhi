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
                <h3 style="text-align:center;text-transform: uppercase">Nhập tồn đầu thực lực</h3>

                <div class="x_panel">
                    <div>
                        <form onsubmit="return nhapton_validate()" class="form-horizontal form-label-left"
                              action="{{route('tonkho.create')}} "
                              method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="donvi" class="control-label col-md-2 col-xs-12 col-md-offset-0"
                                       style="text-align:left;">Đơn vị</label>

                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <select id="donvi" name="nhapTonDau[donvi]" class="select2_single form-control"
                                            data-url="{{route('tonkho.index')}}"
                                            tabindex="-1">
                                        @if(isset($arrDonVi))
                                            @foreach ($arrDonVi as $key => $donVi)
                                                <option @if($key == $donvi_id) selected @endif
                                                value="{{$key}}">{{$donVi}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="hevukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Hệ
                                    vũ khí</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="hevukhi" name="nhapTonDau[hevukhi]" target-table="hevukhi"
                                            update="nhomvukhi" class="select2_single form-control" tabindex="-1">
                                        @if(isset($arrHeVuKhi))
                                            @foreach ($arrHeVuKhi as $key => $heVuKhi)
                                                <option value="{{$key}}"
                                                        @if(old('nhapTonDau')['hevukhi'] == $key) selected @endif>{{$heVuKhi}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <label for="nhomvukhi" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nhóm vũ khí</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select @if(!isset($aryCombobox['aryNhomVuKhi'])) disabled @endif  id="nhomvukhi"
                                            name="nhapTonDau[nhomvukhi]"
                                            target-table="nhomvukhi" update="covukhi"
                                            class="select2_single form-control" tabindex="-1">
                                        @if(isset($aryCombobox['aryNhomVuKhi']))
                                            @foreach ($aryCombobox['aryNhomVuKhi'] as  $nhomVuKhi)
                                                <option value="{{$nhomVuKhi->nhomvukhi_id}}"
                                                        @if(old('nhapTonDau')['nhomvukhi'] == $nhomVuKhi->nhomvukhi_id) selected @endif>{{$nhomVuKhi->nhomvukhi_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="covukhi" class="control-label col-md-2 col-xs-12" for="covukhi"
                                       style="text-align:left;">Cỡ vũ khí</label>

                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <select @if(!isset($aryCombobox['aryCoVuKhi'])) disabled @endif id="covukhi"
                                            name="nhapTonDau[covukhi]"
                                            target-table="covukhi" update="vukhi" class="select2_single form-control"
                                            tabindex="-1">

                                        @if(isset($aryCombobox['aryCoVuKhi']))
                                            @foreach ($aryCombobox['aryCoVuKhi'] as  $coVuKhi)
                                                <option value="{{$coVuKhi->covukhi_id}}"
                                                        @if(old('nhapTonDau')['covukhi'] == $coVuKhi->covukhi_id) selected @endif>{{$coVuKhi->covukhi_name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <label for="vukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Vũ
                                    khí</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select @if(!isset($aryCombobox['aryVuKhi'])) disabled @endif id="vukhi"
                                            name="nhapTonDau[vukhi]" target-table="vukhi"
                                            class="select2_single form-control" tabindex="-1">

                                        @if(isset($aryCombobox['aryVuKhi']))
                                            @foreach ($aryCombobox['aryVuKhi'] as  $vuKhi)
                                                <option value="{{$vuKhi->vukhi_id}}"
                                                        @if(old('nhapTonDau')['vukhi'] == $vuKhi->vukhi_id) selected @endif>{{$vuKhi->vukhi_name}}</option>
                                            @endforeach
                                        @endif


                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="donvitinh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị tính</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="donvitinh" name="nhapTonDau[donvitinh]" target-table="donvitinh"
                                            update="nuocsanxuat" class="select2_single form-control" tabindex="-1">
                                        <?php foreach ($arrDonViTinh as $key => $donViTinh) { ?>
                                        <?php echo '<option value="' . $key . '"   ' . ((old('nhapTonDau')['donvitinh'] == $key) ? 'selected ' : '') . '>' . $donViTinh . '</option>' ?>
                                    <?php } ?>
                                    </select>
                                </div>
                                <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nước sản xuất</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select @if(!isset($aryCombobox['aryNuocsanxuat'])) disabled
                                            @endif  id="nuocsanxuat" name="nhapTonDau[nuocsanxuat]"
                                            class="select2_single form-control" tabindex="-1">

                                        @if(isset($aryCombobox['aryNuocsanxuat']))
                                            @foreach ($aryCombobox['aryNuocsanxuat'] as $nuocSanxuat)
                                                <option value="{{$nuocSanxuat->nuocsanxuat_id}}"
                                                        @if(old('nhapTonDau')['nuocsanxuat'] == $nuocSanxuat->nuocsanxuat_id) selected @endif>{{$nuocSanxuat->nuocsanxuat_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group table-responsive">
                                <table class="table table-bordered" id="">
                                    <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                    <thead style="text-align: center">
                                    <tr>
                                        <th colspan="2">Cấp 1</th>
                                        <th colspan="2">Cấp 2</th>
                                        <th colspan="2">Cấp 3</th>
                                        <th colspan="2">Cấp 4</th>
                                        <th colspan="2">Cấp 5</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap1" name="nhapTonDau[cap1]" type="text"
                                                   class="chatluong form-control col-xs-12 text-right">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap2" name="nhapTonDau[cap2]" type="text"
                                                   class="chatluong form-control col-xs-12 text-right">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap3" name="nhapTonDau[cap3]" type="text"
                                                   class="chatluong form-control col-xs-12 text-right">

                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap4" name="nhapTonDau[cap4]" type="text"
                                                   class="chatluong form-control col-xs-12 text-right">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap5" name="nhapTonDau[cap5]" type="text"
                                                   class="chatluong form-control col-xs-12 text-right">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>


                            @if(Session::has('flash_message_success'))
                                <div class=""
                                     style="width: 50%; min-width: 200px; padding: 5px; margin: auto; text-align: center"><span
                                            class="ace-icon fa fa-check bigger-110 green"></span>{!! session('flash_message_success') !!}
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

                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-round btn-primary" style="width: 150px">Nhập
                                        kho
                                    </button>
                                    <button type="button"
                                            onclick="location.href='{{route('tonkho.index', ['donvi_id' => $donvi_id])}}'"
                                            class="btn btn-round btn-success" style="width: 150px">Nhập
                                        lại
                                    </button>
                                    <a class="btn btn-round btn-danger" style="width: 150px" href="{{url('')}}">Thoát</a>
                                </div>
                            </div>
                            <hr>
                            <div class="">
                                <table class="table table-bordered" id="">
                                    <!--<table id="datatable" class="table table-striped table-bordered text-right">-->
                                    <thead style="text-align: center">
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Đơn vị</th>
                                        <th rowspan="2">Tên vũ khí</th>
                                        <th rowspan="2">NSX</th>
                                        <th rowspan="2">ĐVT</th>
                                        <th colspan="6" style="border-bottom: none;">SỐ lượng</th>
                                        <th colspan="2" style="border-bottom: none;">Admin</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px">+</td>
                                        <td style="width: 10px">C1</td>
                                        <td style="width: 10px">C2</td>
                                        <td style="width: 10px">C3</td>
                                        <td style="width: 10px">C4</td>
                                        <td style="width: 10px">C5</td>
                                        <td style="text-align: center">Sửa</td>
                                        <td style="text-align: center">Xóa</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (count($arrThucLucVuKhi)) {
                                    $start = ($arrThucLucVuKhi->currentPage() - 1) * $arrThucLucVuKhi->perPage();
                                    foreach ($arrThucLucVuKhi as $k => $thucLucVuKhi) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo($start + $k + 1); ?></td>
                                        <td class="text-left"><?php echo $thucLucVuKhi->donvi_name; ?></td>
                                        <td class="text-left"><?php echo $thucLucVuKhi->vukhi_name; ?></td>
                                        <td style="text-align: center"><?php echo $thucLucVuKhi->nuocsanxuat_name; ?></td>
                                        <td style="text-align: center"><?php echo $thucLucVuKhi->donvitinh_name; ?></td>
                                        <td class="text-right"><?php echo $thucLucVuKhi->soluong; ?></td>
                                        <td class="text-right"><?php echo $arrSoLuong[$thucLucVuKhi->thuclucvukhi_id][1]; ?></td>
                                        <td class="text-right"><?php echo $arrSoLuong[$thucLucVuKhi->thuclucvukhi_id][2]; ?></td>
                                        <td class="text-right"><?php echo $arrSoLuong[$thucLucVuKhi->thuclucvukhi_id][3]; ?></td>
                                        <td class="text-right"><?php echo $arrSoLuong[$thucLucVuKhi->thuclucvukhi_id][4]; ?></td>
                                        <td class="text-right"><?php echo $arrSoLuong[$thucLucVuKhi->thuclucvukhi_id][5]; ?></td>
                                        <td style="text-align: center"><a
                                                    href="{{route('tonkho.edit',['id' => $thucLucVuKhi->thuclucvukhi_id])}}"
                                                    class="btn btn-info btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a></td>
                                        <td style="text-align: center"><a
                                                    href="javascript:void(0)"
                                                    onclick="app.nhaptondau.delete({{$thucLucVuKhi->thuclucvukhi_id}}).then(function(isConfirm) { if (isConfirm) { window.location = '{{ route('tonkho.index') }}'; }})"
                                                    class="btn btn-info btn-xs btn-danger"> <i
                                                        class="fa fa-close"></i></a></td>
                                    </tr>
                                    <?php
                                    }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                @if(!empty($arrThucLucVuKhi))
                                    {!! $arrThucLucVuKhi->appends(['donvi_id' =>$donvi_id])->render() !!}
                                @endif
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        var app = app || {};

        (function (app) {
            app.nhaptondau = {
                delete: function (id) {
                    return app.dialog.confirmDelete().then(function () {
                        $(location).attr('href', '/tonkho/nhaptondau/delete/' + id);
//                    }).then(function () {
//                        return sweetAlert({
//                            title: 'Đã xóa!',
//                            text: 'Thực lực vũ khí đã bị xóa!',
//                            type: 'success'
//                        });
//                    }).catch(function (error) {
//                        if (error === 'cancel' || error === 'overlay') {
//                            return;
//                        }
//
//                        return sweetAlert({
//                            title: 'Không xóa được!',
//                            text: 'Có thể đã phát sinh nguyên nhân gì đó khiến việc xóa không thành công!',
//                            type: 'error'
//                        });
                    });
                }
            };
        })(app);


        function nhapton_validate() {
            if ($("#donvi").val() == null || $("#donvi").val() == '') {
                alert('Vui lòng chọn đơn vị');
                return false;
            } else if ($("#hevukhi").val() == null || $("#hevukhi").val() == '') {
                alert('Vui lòng chọn hệ vũ khí');
                return false;
            } else if ($("#nhomvukhi").val() == null || $("#nhomvukhi").val() == '') {
                alert('Vui lòng chọn nhóm vũ khí');
                return false;
            } else if ($("#covukhi").val() == null || $("#covukhi").val() == '') {
                alert('Vui lòng chọn cỡ vũ khí');
                return false;
            } else if ($("#vukhi").val() == null || $("#vukhi").val() == '') {
                alert('Vui lòng chọn vũ khí');
                return false;
            } else if ($("#donvitinh").val() == null || $("#donvitinh").val() == '') {
                alert('Vui lòng chọn đơn vị tính');
                return false;
            } else if ($("#nuocsanxuat").val() == null || $("#nuocsanxuat").val() == '') {
                alert('Vui lòng chọn nước sản xuất');
                return false;
            } else if ($("#cap1").val() == '' && $("#cap2").val() == '' && $("#cap3").val() == '' && $("#cap4").val() == '' && $("#cap5").val() == '') {
                alert('Số vui lòng nhập số lượng vũ khí');
                return false;
            } else {
                return true;
            }
        }
        $(document).ready(function () {
            $('select.form-control').on('change', function () {
                var target_table_value = $(this).val();

                if ($(this).attr('id') == 'donvi') {
                    location.href = $(this).attr('data-url') + '?donvi_id=' + target_table_value;
                    return;
                }

                var target_table = $(this).attr('target-table');
                var update = $(this).attr('update');
                if (target_table_value != null && target_table_value != 'undefined' && target_table != 'undefined' && update != 'undefined') {
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
                                $("#" + update).removeAttr("disabled");
                            }
                            if (target_table == 'hevukhi') {
                                $("#nuocsanxuat").removeAttr("disabled").html(data.html_nsx).select2("val", "");
                                $("#nhomvukhi").select2("val", "");
                                $("#covukhi").attr("disabled", true).select2("val", "");
                                $("#vukhi").attr("disabled", true).select2("val", "");
                            }
                            if (target_table == 'nhomvukhi') {
                                $("#covukhi").select2("val", "");
                                $("#vukhi").attr("disabled", true).select2("val", "");
                            }
                            if (target_table == 'covukhi') {
                                $("#vukhi").select2("val", "");
                            }

                        }
                    });
                }
                ;
                if (target_table == 'covukhi') {
                    $("#vukhi").select2("val", "");
                }
                ;
            });
        });
    </script>
@endsection