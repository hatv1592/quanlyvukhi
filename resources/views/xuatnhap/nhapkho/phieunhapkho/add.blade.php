@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="x_panel">
                    {!! Form::open([
                        'url' => route('xuatnhap.nhapkho.phieunhapkho.create', ($storeKey ? 'nhapkho_key_temp=' . $storeKey : '')),
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'phieunhapkho'
                    ]) !!}

                    <h3 class="text-center text-uppercase">
                        Viết phiếu nhập kho
                        (<label style="font-size: 13px;">
                            {!! Form::checkbox('pnk_type', null, $phieunhapkho && $phieunhapkho['pnk_type'] ? ['checked'] : []) !!}
                            Phiếu chuyển kho
                        </label>)
                    </h3>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Căn cứ vào</label>
                        <div class="col-md-4 {{ $errors->has('cancunhapkho_id') ? 'has-error' : '' }}">
                            {!! Form::select('cancunhapkho_id', $cancunhapkho, $phieunhapkho ? $phieunhapkho['cancunhapkho_id'] : null, [
                                'class' => 'form-control select2_single']) !!}
                            @if ($errors->has('cancunhapkho_id'))
                                <span class="help-block">{{ $errors->first('cancunhapkho_id') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Đơn vị nhập</label>
                        <div class="col-md-4 {{ $errors->has('donvinhap_id') ? 'has-error' : '' }}">
                            {!! Form::select('donvinhap_id', $donvinhap, $phieunhapkho ? $phieunhapkho['donvi_id'] : null, [
                                'class' => 'form-control select2_single',
                                'id' => 'donvinhap']) !!}
                            @if ($errors->has('donvinhap_id'))
                                <span class="help-block">{{ $errors->first('donvinhap_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Về việc</label>
                        <div class="col-md-4 {{ $errors->has('lydonhapkho_id') ? 'has-error' : '' }}">
                            {!! Form::select('lydonhapkho_id', $lydonhapkho, $phieunhapkho ? $phieunhapkho['lydonhapkho_id'] : null, [
                                'class' => 'form-control select2_single']) !!}
                            @if ($errors->has('lydonhapkho_id'))
                                <span class="help-block">{{ $errors->first('lydonhapkho_id') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Đơn vị xuất</label>
                        <div class="col-md-4 {{ $errors->has('donvixuat_name') ? 'has-error' : '' }}">
                            {!! Form::text('donvixuat_name', $phieunhapkho ? $phieunhapkho['donvixuat_name'] : null, [
                                'class' => 'form-control']) !!}
                            @if ($errors->has('donvixuat_name'))
                                <span class="help-block">{{ $errors->first('donvixuat_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Ngày hết hạn</label>
                        <div class="col-md-4 {{ $errors->has('pnk_ngay_hethan') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_ngay_hethan', $phieunhapkho ? $phieunhapkho['pnk_ngay_hethan'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_ngay_hethan']) !!}
                            @if ($errors->has('pnk_ngay_hethan'))
                                <span class="help-block">{{ $errors->first('pnk_ngay_hethan') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Đơn vị vận chuyển</label>
                        <div class="col-md-4 {{ $errors->has('pnk_donvivanchuyen') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_donvivanchuyen', $phieunhapkho ? $phieunhapkho['pnk_donvivanchuyen'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_donvivanchuyen']) !!}
                            @if ($errors->has('pnk_donvivanchuyen'))
                                <span class="help-block">{{ $errors->first('pnk_donvivanchuyen') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Người nhận hàng</label>
                        <div class="col-md-4 {{ $errors->has('pnk_nguoinhanhang') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_nguoinhanhang', $phieunhapkho ? $phieunhapkho['pnk_nguoinhanhang'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_nguoinhanhang']) !!}
                            @if ($errors->has('pnk_nguoinhanhang'))
                                <span class="help-block">{{ $errors->first('pnk_nguoinhanhang') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Phương tiện vận chuyển</label>
                        <div class="col-md-4 {{ $errors->has('pnk_phuongtienvanchuyen') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_phuongtienvanchuyen', $phieunhapkho ? $phieunhapkho['pnk_phuongtienvanchuyen'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_phuongtienvanchuyen']) !!}
                            @if ($errors->has('pnk_phuongtienvanchuyen'))
                                <span class="help-block">{{ $errors->first('pnk_phuongtienvanchuyen') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Người nhận phiếu</label>
                        <div class="col-md-4 {{ $errors->has('pnk_nguoinhanphieu') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_nguoinhanphieu', $phieunhapkho ? $phieunhapkho['pnk_nguoinhanphieu'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_nguoinhanphieu']) !!}
                            @if ($errors->has('pnk_nguoinhanphieu'))
                                <span class="help-block">{{ $errors->first('pnk_nguoinhanphieu') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Thủ trưởng ra lệnh</label>
                        <div class="col-md-4 {{ $errors->has('pnk_nguoiralenh') ? 'has-error' : '' }}">
                            {!! Form::text('pnk_nguoiralenh', $phieunhapkho ? $phieunhapkho['pnk_nguoiralenh'] : null, [
                                'class' => 'form-control',
                                'id' => 'pnk_nguoiralenh']) !!}
                            @if ($errors->has('pnk_nguoiralenh'))
                                <span class="help-block">{{ $errors->first('pnk_nguoiralenh') }}</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Hệ vũ khí</label>
                        <div class="col-md-4 {{ $errors->has('hevukhi_id') ? 'has-error' : '' }}">
                            {!! Form::select('hevukhi_id', $hevukhi, null, [
                                'class' => 'form-control select2_single',
                                'id' => 'hevukhi',
                                'tabindex' => -1,
                                'onchange' => 'app.phieunhapkho.onChangeWeaponSystem(this)']) !!}
                            @if ($errors->has('hevukhi_id'))
                                <span class="help-block">{{ $errors->first('hevukhi_id') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Nhóm vũ khí</label>
                        <div class="col-md-4 {{ $errors->has('nhomvukhi_id') ? 'has-error' : '' }}">
                            {!! Form::select('nhomvukhi_id', $nhomvukhi, null, [
                                'class' => 'form-control select2_single',
                                'id' => 'nhomvukhi',
                                'disabled' => true,
                                'onchange' => 'app.phieunhapkho.onChangeWeaponGroup(this)']) !!}
                            @if ($errors->has('nhomvukhi_id'))
                                <span class="help-block">{{ $errors->first('nhomvukhi_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Cỡ vũ khí</label>
                        <div class="col-md-4 {{ $errors->has('covukhi_id') ? 'has-error' : '' }}">
                            {!! Form::select('covukhi_id', [], '', [
                                'class' => 'form-control select2_single',
                                'id' => 'covukhi',
                                'disabled' => true,
                                'onchange' => 'app.phieunhapkho.onChangeWeaponSize(this)']) !!}
                            @if ($errors->has('covukhi_id'))
                                <span class="help-block">{{ $errors->first('covukhi_id') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Vũ khí</label>
                        <div class="col-md-4 {{ $errors->has('vukhi_id') ? 'has-error' : '' }}">
                            {!! Form::select('vukhi_id', [], '', [
                                'class' => 'form-control select2_single',
                                'id' => 'vukhi',
                                'disabled' => true]) !!}
                            @if ($errors->has('vukhi_id'))
                                <span class="help-block">{{ $errors->first('vukhi_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" style="text-align:left;">Đơn vị tính</label>
                        <div class="col-md-4 {{ $errors->has('donvitinh_id') ? 'has-error' : '' }}">
                            {!! Form::select('donvitinh_id', $donvitinh, null, [
                                'class' => 'form-control select2_single',
                                'tabindex' => -1,
                                'id' => 'donvitinh']) !!}
                            @if ($errors->has('donvitinh_id'))
                                <span class="help-block">{{ $errors->first('donvitinh_id') }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2" style="text-align:left;">Nước sản xuất</label>
                        <div class="col-md-4 {{ $errors->has('nuocsanxuat_id') ? 'has-error' : '' }}">
                            {!! Form::select('nuocsanxuat_id', [], '', [
                                'class' => 'form-control select2_single',
                                'id' => 'nuocsanxuat',
                                'disabled' => true]) !!}
                            @if ($errors->has('nuocsanxuat_id'))
                                <span class="help-block">{{ $errors->first('nuocsanxuat_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    {{-- Phan cap --}}
                    <div class="form-group">
                        <div style="width: 20%;float: left;padding-left: 5px;text-align: center;">
                            <label for="cap1" class="control-label"
                                   style="width: 30%; float: left;text-align: center">Cấp 1:</label>
                            <div style="width: 40%;float: left">
                                <input id="cap1" name="phancap[1]" type="text" value=""
                                       class="chatluong form-control" placeholder="0">
                            </div>
                        </div>
                        <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                            <label for="cap2" class="control-label"
                                   style="width: 30%; float: left;text-align: center">Cấp 2:</label>
                            <div style="width: 40%;float: left">
                                <input id="cap2" name="phancap[2]" type="text" value=""
                                       class="chatluong form-control" placeholder="0">
                            </div>
                        </div>

                        <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                            <label for="cap3" class="control-label"
                                   style="width: 30%; float: left;text-align: center">Cấp 3:</label>
                            <div style="width: 40%;float: left">
                                <input id="cap3" name="phancap[3]" type="text" value=""
                                       class="chatluong form-control" placeholder="0">
                            </div>
                        </div>

                        <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                            <label for="cap4" class="control-label"
                                   style="width: 30%; float: left;text-align: center">Cấp 4:</label>
                            <div style="width: 40%;float: left">
                                <input id="cap4" name="phancap[4]" type="text" value=""
                                       class="chatluong form-control" placeholder="0">
                            </div>
                        </div>

                        <div style="width: 20%;float: left;border-left: 1px solid #ccc;">
                            <label for="cap5" class="control-label"
                                   style="width: 30%; float: left;text-align: center">Cấp 5:</label>
                            <div style="width: 40%;float: left">
                                <input id="cap5" name="phancap[5]" type="text" value=""
                                       class="chatluong form-control" placeholder="0">
                            </div>
                        </div>
                    </div>


                    <hr>

                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Nhập kho</button>
                            @if(isset($storeKey))
                                <button type="button" class="btn btn-success"
                                        onclick="app.phieunhapkho.complete('{{$storeKey}}')">In/ Kết thúc
                                </button>
                            @endif
                            <a href="{{url('/xuatnhap/nhapkho/phieunhapkho')}}" class="btn btn-danger">Thoát</a>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    @if (!empty($thongtinVukhi))
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center text-uppercase">Thông tin vũ khí</h3>
                                <table class="table table-bordered table-custom">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">#</th>
                                            <th rowspan="2" class="text-left">Tên vũ khí</th>
                                            <th rowspan="2" class="text-left">NSX</th>
                                            <th rowspan="2" class="text-left">ĐVT</th>
                                            <th colspan="6" class="width-percent-35">Số lượng</th>
                                            <th rowspan="2" class="width-percent-5">Xóa</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">+</td>
                                            <td class="text-center">C1</td>
                                            <td class="text-center">C2</td>
                                            <td class="text-center">C3</td>
                                            <td class="text-center">C4</td>
                                            <td class="text-center">C5</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($thongtinVukhi as $key => $item)
                                        <tr>
                                            <td class="text-right">{{ $key + 1 }}</td>
                                            <td class="text-left">{{ $item['vukhi']->vukhi_name }}</td>
                                            <td class="text-left">{{ $item['nuocsanxuat']->nuocsanxuat_name }}</td>
                                            <td class="text-left">{{ $item['donvitinh']->donvitinh_name }}</td>
                                            <td class="text-right">{{ array_sum($item['phancap']) }}</td>
                                            <td class="text-right">{{ $item['phancap']['1'] }}</td>
                                            <td class="text-right">{{ $item['phancap']['2'] }}</td>
                                            <td class="text-right">{{ $item['phancap']['3'] }}</td>
                                            <td class="text-right">{{ $item['phancap']['4'] }}</td>
                                            <td class="text-right">{{ $item['phancap']['5'] }}</td>
                                            <td class="text-center">
                                                <button title="Xóa" class="btn btn-danger btn-xs"
                                                        onclick="app.phieunhapkho.deleteVukhiInPhieunhapkho('{{ $key }}', '{{ $storeKey ? $storeKey : '' }}').then(function(isConfirm) { if (isConfirm) window.location.reload(); })">
                                                    <i class="fa fa-close"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            app.phieunhapkho.onChangeWeaponSystem($('#hevukhi'));

            $('#pnk_ngay_hethan').daterangepicker({
                singleDatePicker: true,
                format: 'DD/MM/YYYY',
                calender_style: "picker_4"
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
    <script src="{{ URL::asset('public/js/phieunhapkho.js') }}"></script>
    <script>
        @if(session('nhapkho_message_success'))
            sweetAlert({
            title: "{{ session('nhapkho_message_success') }}",
            type: 'success'
        });
        @endif

        @if(session('nhapkho_message_error'))
         sweetAlert({
            title: "{{ session('nhapkho_message_error') }}",
            type: 'error'
        });
        @endif
    </script>
@endsection