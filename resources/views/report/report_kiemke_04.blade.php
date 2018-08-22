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
                        <th rowspan="3" width="5%" class="text-center">Số thứ tự</th>
                        <th rowspan="3" style="font-size: 15px" class="text-center">Tên vũ khí</th>
                        <th rowspan="3" class="text-center">NSX</th>
                        <th rowspan="3" class="text-center">ĐVT</th>
                        <th rowspan="3" class="text-center">Phân Cấp</th>
                        <th rowspan="3" class="text-center">Số lượng<br/>Còn lại<br/>Theo BC<br/>Trước</th>
                        <th colspan="2" class="text-center red">Số lượng</th>
                        <th rowspan="3" class="text-center ">Tổng số<br/>Hiện có</th>
                        <th rowspan="3" class="text-center ">Thực tế</th>
                        <th colspan="2" class="text-center red">So sánh</th>
                        <th colspan="3" class="text-center red">Tình trạng cất giữ</th>
                        <th colspan="13" class="text-center red">Tình hình đồng bộ</th>
                    </tr>
                    <tr>
                        <th class="text-center red" rowspan="2">Tăng</th>
                        <th class="text-center red" rowspan="2">Giảm</th>
                        <td class="text-center" rowspan="2">
                            Thừa
                        </td>
                        <td class="text-center" rowspan="2">
                            Thiếu
                        </td>
                        <td class="text-center" rowspan="2">
                            Có hòm
                        </td>
                        <td class="text-center" rowspan="2">
                            Trên giá
                        </td>
                        <td class="text-center" rowspan="2">
                            Kê kích
                        </td>
                        <td class="text-center" rowspan="2">
                            Bộ<br/>Khẩu<br/>Đội
                        </td>
                        <td class="text-center" rowspan="2">
                            Bộ<br/>Đại<br/>Đội
                        </td>
                        <td class="text-center" rowspan="2">
                            Bộ<br/>Đoàn
                        </td>
                        <td class="text-center" colspan="3">
                            Kính nghắm
                        </td>
                        <td class="text-center" rowspan="2">
                            Chiếu sáng
                        </td>
                        <td class="text-center" rowspan="2">
                            Hộp tiếp đạn
                        </td>
                        <td class="text-center" rowspan="2">
                            Thông nòng
                        </td>
                        <td class="text-center" colspan="2">
                            Lốp pháo
                        </td>
                        <td class="text-center" rowspan="2">
                            Trang cụ
                        </td>
                        <td class="text-center" rowspan="2">
                            Quân cụ
                        </td>
                    </tr>
                    <tr>
                        <td>Trực Tiếp</td>
                        <td>Gián Tiếp</td>
                        <td>Cao Xạ</td>
                        <td>Tốt</td>
                        <td>Xấu</td>
                    </tr>
                    <?php $stt = 0; ?>
                    <tbody>
                    @foreach($data as $vukhi_id => $aryData)
                        <?php $sum_last_vukhi = $sum_last_nuocsanxuat = $sum_last_donvitinh = 0; ?>
                        <?php $first_show = false; ?>
                        @if(count($aryData) > 5)
                            <?php $sum_total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0]; ?>
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
                                        <td class="text-right">{{n($sum_item['soluong_thucxuat'])}}</td>
                                        <td class="text-right">{{n($sum_item['soluong_cuoi_ky'])}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $first_show = true;
                                    $sum_total['soluong_cuoi_ky'] += $sum_item['soluong_cuoi_ky'];
                                    $sum_total['soluong_dauky'] += $sum_item['soluong_dauky'];
                                    $sum_total['soluong_thucxuat'] += $sum_item['soluong_thucxuat'];
                                    $sum_total['soluong_thucnhap'] += $sum_item['soluong_thucnhap'];

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
                                    <td class="text-right">{{n($sum_total['soluong_thucxuat'])}}</td>
                                    <td class="text-right">{{n($sum_total['soluong_cuoi_ky'])}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        @endif
                        <?php $last_vukhi = $last_nuocsanxuat = $last_donvitinh = 0; $first_item_show = false;?>
                        <?php $total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0]; ?>
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
                                    <td class="text-right">{{n($v['soluong_thucxuat'])}}</td>
                                    <td class="text-right">{{n($v['soluong_cuoi_ky'])}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                $total['soluong_cuoi_ky'] += $v['soluong_cuoi_ky'];
                                $total['soluong_dauky'] += $v['soluong_dauky'];
                                $total['soluong_thucxuat'] += $v['soluong_thucxuat'];
                                $total['soluong_thucnhap'] += $v['soluong_thucnhap'];

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
                                        <td class="text-right">{{n($total['soluong_thucxuat'])}}</td>
                                        <td class="text-right">{{n($total['soluong_cuoi_ky'])}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <?php $total = ['soluong_cuoi_ky' => 0, 'soluong_dauky' => 0, 'soluong_thucxuat' => 0, 'soluong_thucnhap' => 0]; ?>
                                @endif
                                <?php $first_item_show = false; ?>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection