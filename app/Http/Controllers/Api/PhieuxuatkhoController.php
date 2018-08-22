<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\PhieuxuatkhoService;
use Illuminate\Http\Request;

class PhieuxuatkhoController extends Controller
{
    /**
     * @var PhieuxuatkhoService
     */
    private $phieuxuatkhoService;

    /**
     * PhieuxuatkhoController constructor.
     *
     * @param PhieuxuatkhoService $phieuxuatkhoService
     */
    public function __construct(PhieuxuatkhoService $phieuxuatkhoService)
    {
        $this->phieuxuatkhoService = $phieuxuatkhoService;
    }

    /**
     * Search phieuxuatkho
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $params = $request->all();

        return $this->phieuxuatkhoService->searchPhieuxuatkho($params);
    }
}