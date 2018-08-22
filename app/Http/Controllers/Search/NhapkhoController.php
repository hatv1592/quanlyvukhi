<?php


namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Repositories\DonViRepository;
use App\Repositories\LydonhapkhoRepository;

class NhapkhoController extends Controller
{
    /**
     * @var DonViRepository
     */
    private $donviRepository;

    /**
     * @var LydonhapkhoRepository
     */
    private $lydonhapkhoRepository;

    /**
     * NhapkhoController constructor.
     *
     * @param DonViRepository $donviRepository
     * @param LydonhapkhoRepository $lydonhapkhoRepository
     */
    public function __construct(
        DonViRepository $donviRepository,
        LydonhapkhoRepository $lydonhapkhoRepository
    ) {
        $this->donviRepository = $donviRepository;
        $this->lydonhapkhoRepository = $lydonhapkhoRepository;
    }

    /**
     * Search lenh nhap kho screen
     *
     * @return $this
     */
    public function index()
    {
        $donvi = $this->donviRepository->findAllChild();
        $lydonhapkho = $this->lydonhapkhoRepository->findAll();

        return view('search.nhapkho')->with([
            'donvi'         => $donvi->pluck('donvi_name', 'donvi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'lydonhapkho'   => $lydonhapkho->pluck('lydonhapkho_name', 'lydonhapkho_id')->prepend('Chọn tất cả', 0)->toArray(),
        ]);
    }
}
