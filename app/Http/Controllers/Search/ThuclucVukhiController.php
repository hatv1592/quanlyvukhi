<?php


namespace App\Http\Controllers\Search;


use App\Http\Controllers\Controller;
use App\Repositories\CoVuKhiRepository;
use App\Repositories\DonViRepository;
use App\Repositories\DonViTinhRepository;
use App\Repositories\HeVuKhiRepository;
use App\Repositories\NhomVuKhiRepository;
use App\Repositories\NuocSanXuatRepository;
use App\Repositories\VuKhiRepository;

class ThuclucVukhiController extends Controller
{
    /**
     * @var DonViRepository
     */
    private $donviRepository;

    /**
     * @var DonViTinhRepository
     */
    private $donvitinhRepository;

    /**
     * @var HeVuKhiRepository
     */
    private $hevukhiRepository;

    /**
     * @var NhomVuKhiRepository
     */
    private $nhomvukhiRepository;

    /**
     * @var VuKhiRepository
     */
    private $vukhiRepository;

    /**
     * @var NuocSanXuatRepository
     */
    private $nuocsanxuatRepository;

    /**
     * @var CoVuKhiRepository
     */
    private $covukhiRepository;

    /**
     * ThuclucVukhiController constructor.
     *
     * @param DonViRepository $donviRepository
     * @param DonViTinhRepository $donvitinhRepository
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param NhomVuKhiRepository $nhomvukhiRepository
     * @param VuKhiRepository $vukhiRepository
     * @param NuocSanXuatRepository $nuocsanxuatRepository
     * @param CoVuKhiRepository $covukhiRepository
     */
    public function __construct(
        DonViRepository $donviRepository,
        DonViTinhRepository $donvitinhRepository,
        HeVuKhiRepository $heVuKhiRepository,
        NhomVuKhiRepository $nhomvukhiRepository,
        VuKhiRepository $vukhiRepository,
        NuocSanXuatRepository $nuocsanxuatRepository,
        CoVuKhiRepository $covukhiRepository
    ) {
        $this->donviRepository = $donviRepository;
        $this->donvitinhRepository = $donvitinhRepository;
        $this->hevukhiRepository = $heVuKhiRepository;
        $this->nhomvukhiRepository = $nhomvukhiRepository;
        $this->vukhiRepository = $vukhiRepository;
        $this->nuocsanxuatRepository = $nuocsanxuatRepository;
        $this->covukhiRepository = $covukhiRepository;
    }

    /**
     * Search screen
     *
     * @return $this
     */
    public function index()
    {
        $donvi = $this->donviRepository->findAllChild();
        $hevukhi = $this->hevukhiRepository->findAll();
        $donvitinh = $this->donvitinhRepository->findAll();
        $nhomvukhi = $this->nhomvukhiRepository->findAll();
        $vukhi = $this->vukhiRepository->findAll();
        $nuocsanxuat = $this->nuocsanxuatRepository->findAll();
        $covukhi = $this->covukhiRepository->findAll();

        return view('search.thuclucvukhi')->with([
            'donvi'         => $donvi->pluck('donvi_name', 'donvi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'hevukhi'       => $hevukhi->pluck('hevukhi_name', 'hevukhi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'donvitinh'     => $donvitinh->pluck('donvitinh_name', 'donvitinh_id')->prepend('Chọn tất cả', 0)->toArray(),
            'nhomvukhi'     => $nhomvukhi->pluck('nhomvukhi_name', 'nhomvukhi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'vukhi'         => $vukhi->pluck('vukhi_name', 'vukhi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'nuocsanxuat'   => $nuocsanxuat->pluck('nuocsanxuat_name', 'nuocsanxuat_id')->prepend('Chọn tất cả', 0)->toArray(),
            'covukhi'       => $covukhi->pluck('covukhi_name', 'covukhi_id')->prepend('Chọn tất cả', 0)->toArray()
        ]);
    }
}