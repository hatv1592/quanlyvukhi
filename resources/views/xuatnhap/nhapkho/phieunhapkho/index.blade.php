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
    <script src="{{ URL::asset('public/js/phieunhapkho.js') }}"></script>
    <script>
        @if (session('add_phieunhapkho_success'))
            sweetAlert({
                title: "{{ session('add_phieunhapkho_success') }}",
                type: 'success'
            });
        @endif
    </script>
@endsection

@section('content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_content">
            <h3 class="text-center text-uppercase">Danh sách lệnh nhập kho <a
                        href="{{route('xuatnhap.nhapkho.cancunhapkho.index')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff;">Thêm căn cứ nhập kho</span>
                </a>
                <a href="{{route('xuatnhap.nhapkho.phieunhapkho.form')}}" class="btn btn-sm btn-info">
                    <span style="color: #fff">Viết lệnh nhập kho</span>
                </a>
            </h3>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">Tổng số: <strong>{{ $allPhieunhapkho->total() }}</strong> (phiếu nhập
                        kho)
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Số lệnh</th>
                                <th rowspan="2">Ngày tạo</th>
                                <th rowspan="2" class="text-center">Đơn vị xuất</th>
                                <th rowspan="2" class="text-center">Đơn vị nhập</th>
                                <th rowspan="2" class="width-percent-10">Trạng thái</th>
                                <th rowspan="2">In phiếu</th>

                                @if(\App\User::isSuperAdmin())
                                    <th colspan="3">Admin</th>
                                @endif
                            </tr>
                            <tr>
                                @if(\App\User::isSuperAdmin())
                                    <th class="width-percent-5 text-center" style="width: 80px">Hoàn thiện</th>
                                    <th class="width-percent-5 text-center" style="width: 80px">Sửa</th>
                                    <th class="width-percent-5 text-center" style="width: 80px">Xóa</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($allPhieunhapkho as $key => $phieunhapkho)
                            <tr>
                                <td class="text-right vertical-middle">{{ $key + 1 }}</td>
                                <td class="vertical-middle text-center">{{ $phieunhapkho->pnk_sophieu }}</td>
                                <td class="vertical-middle text-center">{{ $phieunhapkho->created_at->format('d/m/Y') }}</td>
                                <td class="vertical-middle text-center">{{ $phieunhapkho->donvixuat_name }}</td>
                                <td class="vertical-middle text-center">{{ $phieunhapkho->DonviNhap->donvi_name }}</td>
                                <td class="vertical-middle text-center">
                                    @if ($phieunhapkho->pnk_status == 1)
                                        <span class="label label-success">Đã thực hiện</span>
                                    @elseif ($phieunhapkho->pnk_status > 1)
                                        <span class="label label-success">Đã đối soát</span>
                                    @else
                                        @if(\App\User::isUser())
                                            <a class="btn btn-info btn-xs"
                                               href="{{route('xuatnhap.phieunhapkho.confirm', ['id' => $phieunhapkho->pnk_id])}}">Thực
                                                hiện</a>
                                        @endif
                                    @endif
                                </td>
                                <td class="vertical-middle text-center">
                                    <a target="_blank"
                                       href="{{route('xuatnhap.inphieunhapkho', $phieunhapkho->pnk_id)}}"
                                       class="btn btn-info btn-xs">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                @if(\App\User::isSuperAdmin())
                                    <td class="text-center vertical-middle">
                                        @if ($phieunhapkho->pnk_status === 1)
                                            <a class="btn btn-info btn-xs"
                                               href="{{route('xuatnhap.phieunhapkho.admin_confirm', ['id' => $phieunhapkho->pnk_id])}}">Sửa</a>
                                        @elseif ($phieunhapkho->pnk_status < 1)
                                            Chưa thực hiện
                                        @else
                                            Không sửa
                                        @endif
                                    </td>
                                    <td class="text-center vertical-middle">
                                        @if ($phieunhapkho->pnk_status === 0)
                                            <a href="{{route('xuatnhap.nhapkho.phieunhapkho.edit', $phieunhapkho->pnk_id)}}" class="btn btn-info btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @else
                                            Không sửa
                                        @endif
                                    </td>
                                    <td class="text-center vertical-middle">
                                        @if ($phieunhapkho->pnk_status <= 1)
                                            <a
                                                    href="javascript:void(0)"
                                                    onclick="if(confirm('Bạn chắc chắn xóa phiếu nhập kho, việc này không thể khôi phục. Hãy cẩn trọng.')) { location.href='{{route('xuatnhap.phieunhapkho.admin_delete', ['id' => $phieunhapkho->pnk_id])}}';}"
                                                    class="btn btn-info btn-xs btn-danger"> <i
                                                        class="fa fa-close"></i></a>
                                        @else
                                            Không xóa
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="row">
                <div class="col-md-12">
                    {{ $allPhieunhapkho->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection