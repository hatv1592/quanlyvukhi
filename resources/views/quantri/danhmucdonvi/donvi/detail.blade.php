@extends('../master')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản trị đơn vị</h2>
                <ul class="nav navbar-right panel_toolbox reset-min-with">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="x_panel">
                    @if (isset($notFound) && $notFound)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="text-uppercase text-danger">Lỗi, không tìm thấy đơn vị với ID
                                    = {{ $id  }}</h3>
                                <a href="{{ route('quantri.danhmucdonvi.donvi.index') }}" class="btn btn-primary">Quay
                                    lại</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-uppercase">Chi tiết thực lực đơn vị</h3>

                        <div class="row">
                            <div class="col-md-push-3 col-md-6">
                                {!! Form::open(['url' => route('quantri.danhmucdonvi.donvi.update', $unit->donvi_id), 'class' => 'form-horizontal form-label-left']) !!}
                                {{--<div class="form-group {{ $errors->has('donvi_name') ? 'has-error' : '' }}">--}}
                                {!! Form::label('donvi_name', 'Tên đơn vị', ['class' => 'control-label']) !!}
                                {!! Form::text('donvi_name', $unit->donvi_name, ['disabled'=>'disabled','class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên đơn vị']) !!}
                                @if ($errors->has('donvi_name'))
                                    <span class="help-block">{{ $errors->first('donvi_name') }}</span>
                                @endif
                                {{--</div>--}}

                                <div class="form-group {{ $errors->has('donvi_short_name') ? 'has-error' : '' }}">
                                    {!! Form::label('donvi_short_name', 'Mô tả', ['class' => 'control-label']) !!}
                                    {!! Form::text('donvi_short_name', $unit->donvi_short_name, ['disabled'=>'disabled','class' => 'form-control', 'placeholder' => 'Vui lòng nhập tên viết tắt']) !!}
                                    @if ($errors->has('donvi_short_name'))
                                        <span class="help-block">{{ $errors->first('donvi_short_name') }}</span>
                                    @endif
                                </div>

                                @if (!isset($parentIdDonvi))
                                    {{--<div class="form-group {{ $errors->has('donvi_parent') ? 'has-error' : '' }}">--}}
                                    {{--{!! Form::label('donvi_parent', 'Đơn vị cha', ['class' => 'control-label']) !!}--}}
                                    {{--{!! Form::select('donvi_parent', $parentUnits, $unit->donvi_parent, ['disabled'=>'disabled','class' => 'form-control select2_single']) !!}--}}
                                    {{--@if ($errors->has('donvi_parent'))--}}
                                    {{--<span class="help-block">{{ $errors->first('donvi_parent') }}</span>--}}
                                    {{--@endif--}}
                                    {{--</div>--}}
                                @endif

                                {{--                                {!! Form::submit('Sửa', ['class' => 'btn btn-primary']) !!}--}}
                                {{--<button type="button" onclick="app.donvi.delete({{ $unit->donvi_id }}).then(function(isConfirm) { if (isConfirm) {  window.location = '{{ route('quantri.danhmucdonvi.donvi.index') }}'; } })" class="btn btn-danger">Xóa</button>--}}
                                <a href="{{ route('quantri.danhmucdonvi.donvi.index') }}" class="btn btn-warning">Quay
                                    lại</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                </div>
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
                        }else {
                            echo '<span style="color: red">Đơn vị hiện chưa có tồn đầu thực lực</span>';
                        }
                        ?>
                        </tbody>
                    </table>
                    @if(!empty($arrThucLucVuKhi))
                        {{--                        {!! $arrThucLucVuKhi->appends(['donvi_id' =>$donvi_id])->render() !!}--}}
                    @endif
                </div>
            </div>
            {{-- Pagination --}}
            <div class="row">
                <div class="col-md-12">
                    @if(!empty($arrThucLucVuKhi))
                        {!! $arrThucLucVuKhi->render() !!}
                    @endif
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
    <script src="{{ URL::asset('public/js/donvi.js') }}"></script>
    <script>
        @if(session('update-donvi-success'))
            sweetAlert({
            title: "{{ session('update-donvi-success') }}",
            type: 'success'
        });
        @endif
    </script>
@endsection