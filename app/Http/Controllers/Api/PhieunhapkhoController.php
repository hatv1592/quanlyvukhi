<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\PhieunhapkhoService;
use Illuminate\Http\Request;

class PhieunhapkhoController extends Controller
{
    /**
     * @var PhieunhapkhoService
     */
    private $phieunhapkhoService;

    /**
     * PhieunhapkhoController constructor.
     *
     * @param PhieunhapkhoService $phieunhapkhoService
     */
    public function __construct(PhieunhapkhoService $phieunhapkhoService)
    {
        $this->phieunhapkhoService = $phieunhapkhoService;
    }

    /**
     * Search phieunhapkho
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $params = $request->all();

        return $this->phieunhapkhoService->searchPhieunhapkho($params);
    }
}