@extends('../master_print')
@section('content')
    <?php
    if (!function_exists('n')) {
        function n($int, $default_if_zero = '-')
        {
            return ($int == 0) ? $default_if_zero : $int;
        }
    }

    ?>
    <div class="container print " style="width: 95%">

        @include('report.title_report')
        @include('report.btn_export_report')
        <div class="row body">
            <div class="col-xs-12">
                <table class="table-bordered" style="border: 2px #aaa solid; margin: auto">
                    <tr>
                        <th rowspan="2" width="5%" class="text-center">Số thứ tự</th>
                        <th rowspan="2" style="font-size: 15px" class="text-center">Tên vũ khí</th>
                        <th rowspan="2" class="text-center">NSX</th>
                        <th rowspan="2" class="text-center">ĐVT</th>
                        <th rowspan="2" class="text-center">Phân Cấp</th>
                        <th rowspan="2" class="text-center">Số lượng<br/>Còn lại<br/>Theo BC<br/>Trước</th>
                        <th colspan="{{(1+count($aryLyDoNhapKho))}}" class="text-center">Chi tiết Nhập</th>
                        <th colspan="{{(1+count($aryLyDoXuatKho))}}" class="text-center">Chi tiết xuất</th>
                        <th rowspan="2" class="text-center">Tổng số<br/>Hiện có</th>
                    </tr>
                    <tr>
                        <th class="text-center">Cộng</th>
                        @foreach($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name)
                            <th class="text-center">{{$lydonhapkho_name}}</th>
                        @endforeach
                        <th class="text-center">Cộng</th>
                        @foreach($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name)
                            <th class="text-center">{{$lydoxuatkho_name}}</th>
                        @endforeach
                    </tr>
                    <?php $stt = 0; ?>
                    <tbody>
                    @foreach($data as $vukhi_id => $aryData)
                        <?php $sum_last_vukhi = $sum_last_nuocsanxuat = $sum_last_donvitinh = 0; ?>
                        <?php $first_show = false; ?>
                        @if(count($aryData) > 5)
                            <?php $sum_total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0, 'soluong_thucnhap_lydo' => $aryLyDoNhapKhoTemplate, 'soluong_thucxuat_lydo' => $aryLyDoXuatKhoTemplate]; ?>
                            @foreach($sum[$vukhi_id] as $k => $sum_item)
                                @if($sum_item['soluong_thucnhap'] > 0 || $sum_item['soluong_thucxuat'] > 0)
                                    @if(!$first_show)
                                        <?php $stt++; ?>
                                    @endif
                                    <tr class="bg-success">
                                        <td class="text-center">@if(!$first_show){{$stt}}@endif
                                            {{--sss{{(int)$first_show}}--}}
                                        </td>
                                        <td class="text-left">
                                            @if(!$first_show)
                                                {{$sum_item['row']['vukhi_name']}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($sum_last_nuocsanxuat != $sum_item['row']['nuocsanxuat_id'])
                                                +
                                            @endif
                                        </td>
                                        <td class="text-center">@if($sum_last_donvitinh != $sum_item['row']['donvitinh_id']){{$sum_item['row']['donvitinh_name']}}@endif</td>
                                        <td class="text-center">{{$sum_item['row']['phancap_id']}}</td>
                                        <td class="text-right">{{n($sum_item['soluong_dauky'])}}</td>
                                        <td class="text-right">{{n($sum_item['soluong_thucnhap'])}}</td>
                                        @foreach($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name)
                                            <td class="text-right">
                                                @if(isset($sum_item['soluong_thucnhap_lydo'][$lydonhapkho_id]))
                                                    {{n($sum_item['soluong_thucnhap_lydo'][$lydonhapkho_id])}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-right">{{n($sum_item['soluong_thucxuat'])}}</td>
                                        @foreach($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name)
                                            <td class="text-right">
                                                @if(isset($sum_item['soluong_thucxuat_lydo'][$lydoxuatkho_id]))
                                                    {{n($sum_item['soluong_thucxuat_lydo'][$lydoxuatkho_id])}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-right">{{n($sum_item['soluong_cuoi_ky'])}}</td>
                                    </tr>
                                    <?php
                                    $first_show = true;
                                    $sum_total['soluong_cuoi_ky'] += $sum_item['soluong_cuoi_ky'];
                                    $sum_total['soluong_dauky'] += $sum_item['soluong_dauky'];
                                    $sum_total['soluong_thucxuat'] += $sum_item['soluong_thucxuat'];
                                    $sum_total['soluong_thucnhap'] += $sum_item['soluong_thucnhap'];

                                    foreach ($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name) {
                                        $sum_total['soluong_thucnhap_lydo'][$lydonhapkho_id] += isset($sum_item['soluong_thucnhap_lydo'][$lydonhapkho_id]) ? $sum_item['soluong_thucnhap_lydo'][$lydonhapkho_id] : 0;
                                    }
                                    foreach ($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name) {
                                        $sum_total['soluong_thucxuat_lydo'][$lydoxuatkho_id] += isset($sum_item['soluong_thucxuat_lydo'][$lydoxuatkho_id]) ? $sum_item['soluong_thucxuat_lydo'][$lydoxuatkho_id] : 0;
                                    }

                                    $sum_last_vukhi = $sum_item['row']['vukhi_id'];
                                    $sum_last_nuocsanxuat = $sum_item['row']['nuocsanxuat_id'];
                                    $sum_last_donvitinh = $sum_item['row']['donvitinh_id'];
                                    ?>
                                @endif
                            @endforeach
                            @if($first_show)
                                <tr class="bg-green" style="font-weight: bold; font-size: 14px;">
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">+</td>
                                    <td class="text-right">{{n($sum_total['soluong_dauky'])}}</td>
                                    <td class="text-right">{{n($sum_total['soluong_thucnhap'])}}</td>
                                    @foreach($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name)
                                        <td class="text-right">
                                            @if(isset($sum_total['soluong_thucnhap_lydo'][$lydonhapkho_id]))
                                                {{n($sum_total['soluong_thucnhap_lydo'][$lydonhapkho_id])}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-right">{{n($sum_total['soluong_thucxuat'])}}</td>
                                    @foreach($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name)
                                        <td class="text-right">
                                            @if(isset($sum_total['soluong_thucxuat_lydo'][$lydoxuatkho_id]))
                                                {{n($sum_total['soluong_thucxuat_lydo'][$lydoxuatkho_id])}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-right">{{n($sum_total['soluong_cuoi_ky'])}}</td>
                                </tr>
                            @endif
                        @endif
                        <?php $last_vukhi = $last_nuocsanxuat = $last_donvitinh = 0; $first_item_show = false;?>
                        <?php $total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0, 'soluong_thucnhap_lydo' => $aryLyDoNhapKhoTemplate, 'soluong_thucxuat_lydo' => $aryLyDoXuatKhoTemplate]; ?>
                        @foreach($aryData as $v)
                            @if($v['soluong_thucnhap'] > 0 || $v['soluong_thucxuat'] > 0)
                                @if(!$first_show && !$first_item_show)
                                    <?php $stt++; ?>
                                @endif
                                <tr>
                                    <td class="text-center">@if(!$first_item_show && !$first_show){{$stt}}@endif
                                        {{--ssss{{(int)$first_item_show}}--}}
                                    </td>
                                    <td class="text-left">@if(!$first_item_show && !$first_show){{$v['vukhi_name']}}@endif</td>
                                    <td class="text-center">@if($last_nuocsanxuat != $v['nuocsanxuat_id']){{$v['nuocsanxuat_name']}}@endif</td>
                                    <td class="text-center">@if($last_donvitinh != $v['donvitinh_id']){{$v['donvitinh_name']}}@endif</td>
                                    <td class="text-center">{{$v['phancap_id']}}</td>
                                    <td class="text-right">{{n($v['soluong_dauky'])}}</td>
                                    <td class="text-right">{{n($v['soluong_thucnhap'])}}</td>
                                    @foreach($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name)
                                        <td class="text-right">
                                            @if(isset($v['soluong_thucnhap_lydo'][$lydonhapkho_id]))
                                                {{n($v['soluong_thucnhap_lydo'][$lydonhapkho_id])}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-right">{{n($v['soluong_thucxuat'])}}</td>
                                    @foreach($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name)
                                        <td class="text-right">
                                            @if(isset($v['soluong_thucxuat_lydo'][$lydoxuatkho_id]))
                                                {{n($v['soluong_thucxuat_lydo'][$lydoxuatkho_id])}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-right">{{n($v['soluong_cuoi_ky'])}}</td>
                                </tr>
                                <?php
                                $total['soluong_cuoi_ky'] += $v['soluong_cuoi_ky'];
                                $total['soluong_dauky'] += $v['soluong_dauky'];
                                $total['soluong_thucxuat'] += $v['soluong_thucxuat'];
                                $total['soluong_thucnhap'] += $v['soluong_thucnhap'];

                                foreach ($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name) {
                                    if (isset($total['soluong_thucnhap_lydo'][$lydonhapkho_id])) {
                                        $total['soluong_thucnhap_lydo'][$lydonhapkho_id] += isset($v['soluong_thucnhap_lydo'][$lydonhapkho_id]) ? $v['soluong_thucnhap_lydo'][$lydonhapkho_id] : 0;
                                    } else {
                                        $total['soluong_thucnhap_lydo'][$lydonhapkho_id] = isset($v['soluong_thucnhap_lydo'][$lydonhapkho_id]) ? $v['soluong_thucnhap_lydo'][$lydonhapkho_id] : 0;
                                    }
                                }

                                foreach ($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name) {
                                    if (isset($total['soluong_thucxuat_lydo'][$lydoxuatkho_id])) {
                                        $total['soluong_thucxuat_lydo'][$lydoxuatkho_id] += isset($v['soluong_thucxuat_lydo'][$lydoxuatkho_id]) ? $v['soluong_thucxuat_lydo'][$lydoxuatkho_id] : 0;
                                    } else {
                                        $total['soluong_thucxuat_lydo'][$lydoxuatkho_id] = isset($v['soluong_thucxuat_lydo'][$lydoxuatkho_id]) ? $v['soluong_thucxuat_lydo'][$lydoxuatkho_id] : 0;
                                    }
                                }
                                $first_item_show = true;
                                ?>
                            {{--@else--}}
                                {{--<tr>--}}
                                    {{--<td colspan="10"> s55{{(int)$first_item_show}}</td>--}}
                                {{--</tr>--}}
                                <?php
                                $last_vukhi = $v['vukhi_id'];
                                $last_nuocsanxuat = $v['nuocsanxuat_id'];
                                $last_donvitinh = $v['donvitinh_id'];

                                ?>
                            @endif


                            @if ($v['phancap_id'] == 5)
                                @if ($first_item_show)
                                    <tr class="bg-warning" style="font-weight: bold; font-size: 14px;">
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">+</td>
                                        <td class="text-right">{{n($total['soluong_dauky'])}}</td>
                                        <td class="text-right">{{n($total['soluong_thucnhap'])}}</td>
                                        @foreach($aryLyDoNhapKho as $lydonhapkho_id => $lydonhapkho_name)
                                            <td class="text-right">
                                                @if(isset($total['soluong_thucnhap_lydo'][$lydonhapkho_id]))
                                                    {{n($total['soluong_thucnhap_lydo'][$lydonhapkho_id])}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-right">{{n($total['soluong_thucxuat'])}}</td>
                                        @foreach($aryLyDoXuatKho as $lydoxuatkho_id => $lydoxuatkho_name)
                                            <td class="text-right">
                                                @if(isset($total['soluong_thucxuat_lydo'][$lydoxuatkho_id]))
                                                    {{n($total['soluong_thucxuat_lydo'][$lydoxuatkho_id])}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-right">{{n($total['soluong_cuoi_ky'])}}</td>
                                    </tr>

                                    <?php $total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0]; ?>
                                @endif
                                <?php $last_vukhi = $last_nuocsanxuat = $last_donvitinh = 0; $first_item_show = false; ?>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection