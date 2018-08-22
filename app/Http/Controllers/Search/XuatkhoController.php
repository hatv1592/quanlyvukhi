<?php


namespace App\Http\Controllers\Search;


use App\Http\Controllers\Controller;
use App\Repositories\DonViRepository;
use App\Repositories\LydoxuatkhoRepository;

class XuatkhoController extends Controller
{
    /**
     * @var DonViRepository
     */
    private $donviRepository;

    /**
     * @var LydoxuatkhoRepository
     */
    private $lydoxuatkhoRepository;

    /**
     * XuatkhoController constructor.
     *
     * @param DonViRepository $donviRepository
     * @param LydoxuatkhoRepository $lydoxuatkhoRepository
     */
    public function __construct(
        DonViRepository $donviRepository,
        LydoxuatkhoRepository $lydoxuatkhoRepository
    ) {
        $this->donviRepository = $donviRepository;
        $this->lydoxuatkhoRepository = $lydoxuatkhoRepository;
    }

    /**
     * Search lenh xuat kho screen
     *
     * @return $this
     */
    public function index()
    {
        $donvi = $this->donviRepository->findAllChild();
        $lydoxuatkho = $this->lydoxuatkhoRepository->findAll();

        return view('search.xuatkho')->with([
            'donvi'         => $donvi->pluck('donvi_name', 'donvi_id')->prepend('Chọn tất cả', 0)->toArray(),
            'lydoxuatkho'   => $lydoxuatkho->pluck('lydoxuatkho_name', 'lydoxuatkho_id')->prepend('Chọn tất cả', 0)->toArray(),
        ]);
    }
}