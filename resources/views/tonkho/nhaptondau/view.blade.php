@extends('../master')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <h3 style="text-align:center;text-transform: uppercase">Sửa tồn đầu thực lục</h3>
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
                        <form onsubmit="return nhapton_validate()" class="form-horizontal form-label-left"
                              action="{{route('tonkho.update',array('id'=>$thucLucVuKhi->thuclucvukhi_id))}} "
                              method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="donvi" class="control-label col-md-2 col-xs-12 col-md-offset-0"
                                       style="text-align:left;">Đơn vị</label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <select id="donvi" name="nhapTonDau[donvi]" class="select2_single form-control"
                                            tabindex="-1">
                                        <?php echo $arrDonVi?>
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
                                        <?php echo $arrHeVuKhi?>
                                    </select>
                                </div>
                                <label for="nhomvukhi" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nhóm vũ khí</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select @if(!isset($arrNhomVuKhi))  @endif  id="nhomvukhi"
                                            name="nhapTonDau[nhomvukhi]"
                                            target-table="nhomvukhi" update="covukhi"
                                            class="select2_single form-control" tabindex="-1">
                                        <?php echo $arrNhomVuKhi?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="covukhi" class="control-label col-md-2 col-xs-12" for="covukhi"
                                       style="text-align:left;">Cỡ vũ khí</label>
                                <div class="hrcol-md-4 col-sm-4 col-xs-12">
                                    <select id="covukhi" name="nhapTonDau[covukhi]"
                                            target-table="covukhi" update="vukhi" class="select2_single form-control"
                                            tabindex="-1">
                                        <?php echo $arrCoVuKhi?>
                                    </select>
                                </div>
                                <label for="vukhi" class="control-label col-md-2 col-xs-12" style="text-align:left;">Vũ
                                    khí</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="vukhi" name="nhapTonDau[vukhi]" target-table="vukhi"
                                            class="select2_single form-control" tabindex="-1">
                                        <?php echo $arrVuKhi?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="donvitinh" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Đơn vị tính</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="donvitinh" name="nhapTonDau[donvitinh]" target-table="donvitinh"
                                            update="nuocsanxuat" class="select2_single form-control" tabindex="-1">
                                        <?php echo $arrDonViTinh?>
                                    </select>
                                </div>
                                <label for="nuocsanxuat" class="control-label col-md-2 col-xs-12"
                                       style="text-align:left;">Nước sản xuất</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select id="nuocsanxuat" name="nhapTonDau[nuocsanxuat]"
                                            class="select2_single form-control" tabindex="-1">
                                        <?php echo $arrNuocSanXuat ?>
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
                                            <input id="cap1" name="nhapTonDau[cap1]" value="{{$soLuong[1]}}" type="text"
                                                   class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap2" name="nhapTonDau[cap2]" value="{{$soLuong[2]}}" type="text"
                                                   class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap3" name="nhapTonDau[cap3]" value="{{$soLuong[3]}}" type="text"
                                                   class="chatluong form-control col-xs-12" placeholder="0">

                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap4" name="nhapTonDau[cap4]" value="{{$soLuong[4]}}" type="text"
                                                   class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                        <td colspan="2" style="text-align: center">
                                            <input id="cap5" name="nhapTonDau[cap5]" value="{{$soLuong[5]}}" type="text"
                                                   class="chatluong form-control col-xs-12" placeholder="0">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-round btn-primary" style="width: 150px">Nhập
                                        kho
                                    </button>
                                    <button type="reset" class="btn btn-round btn-success" style="width: 150px">Nhập
                                        lại
                                    </button>
                                    <button class="btn btn-round btn-danger" style="width: 150px">Thoát</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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