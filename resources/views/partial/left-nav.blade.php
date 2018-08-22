<?php
function getAllMenu()
{
    return [
            1 => [
                    'id' => 1,
                    'name' => 'Xuất nhập',
                    'url' => '#',
                    'data' => [
                            11 => [
                                    'id' => 11,
                                    'name' => 'Nhập kho',
                                    'url' => url('/xuatnhap/nhapkho/phieunhapkho'),
                            ],
                            12 => [
                                    'id' => 12,
                                    'name' => 'Đối chiếu dữ liệu nhập kho',
                                    'url' => 'javascript::void(0)',
                                    'data' => [
                                            111 => [
                                                    'id' => 111,
                                                    'name' => 'Xuất dữ liệu gửi cấp trên',
                                                    'url' => url('/sync/nhapkho/index'),
                                            ],
                                            112 => [
                                                    'id' => 112,
                                                    'name' => 'Đối chiếu dữ liệu với đơn vị',
                                                    'url' => url('/sync/nhapkho/compare'),
                                            ],]
                            ],
                            13 => [
                                    'id' => 13,
                                    'name' => 'Xuất kho',
                                    'url' => url('/xuatnhap/dsxuatkho'),

                            ],
                            14 => [
                                    'id' => 14,
                                    'name' => 'Đối chiếu dữ liệu xuất kho',
                                    'url' => 'javascript::void(0)',
                                    'data' => [
                                            141 => [
                                                    'id' => 141,
                                                    'name' => 'Xuất dữ liệu gửi cấp trên',
                                                    'url' => url('/sync/xuatkho/index'),
                                            ],
                                            142 => [
                                                    'id' => 142,
                                                    'name' => 'Đối chiếu dữ liệu với đơn vị',
                                                    'url' => url('/sync/xuatkho/compare'),
                                            ],
                                    ]
                            ],
//                            14 => [
//                                    'id' => 14,
//                                    'name' => 'Cập nhập tăng giảm',
//                                    'url' => 'javascript::void(0)',
//                            ]
                    ],
            ],
            2 => [
                    'id' => 2,
                    'name' => 'Báo cáo',
                    'url' => 'javascript::void(0)',
                    'data' => [
                            21 => [
                                    'id' => 21,
                                    'name' => 'Báo cáo xuất nhập',
                                    'url' => route('report.tinhhinhxuatnhap'),
                            ],
                            22 => [
                                    'id' => 22,
                                    'name' => 'Báo cáo thực lực',
                                    'url' => route('report.tanggiamthucluc'),
                            ],
                            23 => [
                                    'id' => 23,
                                    'name' => 'Báo cáo tồn kho',
                                    'url' => route('report.baocaotonkho'),
                            ],
                            24 => [
                                    'id' => 24,
                                    'name' => 'Báo cáo kiểm kê',
                                    'url' => route('report.baocaokiemke'),
                            ],
                            26 => [
                                    'id' => 26,
                                    'name' => 'Xử lý cáo bằng file',
                                    'url' => 'javascript::void(0)',
                            ]
                    ],
            ],
            3 => [
                    'id' => 3,
                    'name' => 'Tìm kiếm',
                    'url' => 'javascript::void(0)',
                    'data' => [
                            31 => [
                                    'id' => 31,
                                    'name' => 'Lệnh nhập kho',
                                    'url' => '/search/nhapkho',
                            ],
                            32 => [
                                    'id' => 32,
                                    'name' => 'Lệnh xuất kho',
                                    'url' => '/search/xuatkho',
                            ],
                            33 => [
                                    'id' => 33,
                                    'name' => 'Thực lực vũ khí',
                                    'url' => '/search/thuclucvukhi',
                            ],
//                            34 => [
//                                    'id' => 34,
//                                    'name' => 'Thực lực dồng bộ',
//                                    'url' => 'javascript::void(0)',
//                            ],
//                            35 => [
//                                    'id' => 35,
//                                    'name' => 'Số hiệu vũ khí',
//                                    'url' => 'javascript::void(0)',
//                            ],
                    ],
            ],
            4 => [
                    'id' => 4,
                    'name' => 'Tồn kho',
                    'url' => 'javascript::void(0)',
                    'data' => [
                            41 => [
                                    'id' => 41,
                                    'name' => 'Nhập tồn đầu',
                                    'url' => url('/tonkho/nhaptondau'),
                            ],
//                            42 => [
//                                    'id' => 42,
//                                    'name' => 'Sửa số liệu tồn kho',
//                                    'url' => 'javascript::void(0)',
//                            ],
                            43 => [
                                    'id' => 43,
                                    'name' => 'Đồng bộ dữ liệu tồn kho',
                                    'url' => 'javascript::void(0)',
                                    'data' => [
                                            431 => [
                                                    'id' => 431,
                                                    'name' => 'Xuất dữ liệu gửi cấp trên',
                                                    'url' => url('/sync/tonkho/index'),
                                            ],
                                            442 => [
                                                    'id' => 442,
                                                    'name' => 'Đối chiếu dữ liệu với đơn vị',
                                                    'url' => url('/sync/tonkho/compare'),
                                            ],]
                            ],
                    ],
            ],
//            5 => [
//                    'id' => 5,
//                    'name' => 'Danh mục',
//                    'url' => 'javascript::void(0)',
//                    'data' => [
//                            51 => [
//                                    'id' => 51,
//                                    'name' => 'Vũ khí',
//                                    'url' => 'javascript::void(0)',
//                            ],
//                            52 => [
//                                    'id' => 52,
//                                    'name' => 'Xuất nhập',
//                                    'url' => 'javascript::void(0)',
//                            ],
//                            53 => [
//                                    'id' => 53,
//                                    'name' => 'Danh mục đơn vị',
//                                    'url' => 'javascript::void(0)',
//                            ],
//                            54 => [
//                                    'id' => 54,
//                                    'name' => 'Danh mục khác',
//                                    'url' => 'javascript::void(0)',
//                            ],
//                    ],
//            ],


    ];
}
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title">
                <img src="{{url::asset('public/production/images/img.jpg')}}" style="width: 34px;margin-left: 5px;margin-top: 5px;"
                     alt="..." class="img-circle profile_img" >
                <span style="font-size: 18px;">QUẢN LÝ VŨ KHÍ</span>
            </a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile" style="cursor: pointer;" onclick="location.href='/'">
            <div class="profile_pic">
                <img src="{{url::asset('public/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>NGHIỆP VỤ THƯỜNG XUYÊN</h3>
                <ul class="nav side-menu">
                    <?php
                    $navLeft = getAllMenu();
                    foreach ($navLeft as $mn) {
                    ?>
                    <li>
                        <a>
                            <i class="fa fa-home"></i> <?php echo $mn['name']; ?>
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <?php
                            foreach ($mn['data'] as $child) {
                            ?>
                            <li>
                                <a href="<?php echo $child['url'] ?>">
                                    <?php echo $child['name']; ?>
                                </a>
                                <?php if (isset($child['data']) && count($child['data'])) { ?>
                                <ul class="nav child_menu">
                                    <?php
                                    foreach ($child['data'] as $children) {
                                    ?>
                                    <li>
                                        <a href="<?php echo $children['url'] ?>"><?php echo $children['name']; ?></a>
                                    </li>
                                    <?php }?>
                                </ul>
                                <?php }?>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            @if (Auth::check() && Auth::user()->role >= 5)
                <div class="menu_section">
                    <h3>Quản Trị Hệ Thống</h3>
                    <ul class="nav side-menu">

                        <li><a><i class="fa fa-bug"></i> Quản trị người dùng <span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('/quantri/quantringuoidung/thanhvien')}}">Quản trị người dùng</a>
                                </li>
                                {{--<li><a href="javascript::void(0);">Thống kê đăng nhập</a>--}}
                                {{--</li>--}}
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-sitemap"></i> Quản trị danh mục<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="#level1_1">Danh mục vũ khí <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{url('/quantri/danhmucvukhi/hevukhi')}}">Hệ vũ
                                                khí<span></span></a>
                                        </li>
                                        <li>
                                            <a href="{{url('/quantri/danhmucvukhi/nhomvukhi')}}">Nhóm vũ khí</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/quantri/danhmucvukhi/covukhi')}}">Cỡ vũ khí</a>
                                        </li>
                                        <li><a href="{{url('/quantri/danhmucvukhi/kieuvukhi')}}">Vũ khí</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#level1_1">Xuất - Nhập<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{url('/quantri/nhapxuat/lydoxuatkho')}}">Lý do xuất
                                                kho<span></span></a>
                                        </li>
                                        <li>
                                            <a href="{{url('/quantri/nhapxuat/lydonhapkho')}}">Lý do nhập kho</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#level1_1">Danh mục đơn vị<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">

                                        <li>
                                            <a href="{{ url('/quantri/danhmucdonvi/donvi') }}">Danh mục đơn vị</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#level1_1">Danh mục khác<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{ url('/quantri/danhmuckhac/donvitinh') }}">Đơn vị
                                                tính<span></span></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/quantri/danhmuckhac/nuocsanxuat') }}">Nước sản xuất</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-folder-open"></i>Sao lưu/phục hồi dữ liệu<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('/backup')}}">Sao lưu dữ liệu</a>
                                </li>
                                <li><a href="{{url('/backup/restore')}}">Phục hồi dữ liệu</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <!-- /sidebar menu

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>