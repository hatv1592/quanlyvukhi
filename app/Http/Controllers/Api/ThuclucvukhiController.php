<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\ThuclucvukhiService;
use Illuminate\Http\Request;

class ThuclucvukhiController extends Controller
{
    /**
     * @var ThuclucvukhiService
     */
    private $thuclucvukhiService;

    /**
     * ThuclucvukhiController constructor.
     *
     * @param ThuclucvukhiService $thuclucvukhiService
     */
    public function __construct(ThuclucvukhiService $thuclucvukhiService)
    {
        $this->thuclucvukhiService = $thuclucvukhiService;
    }

    /**
     * Search all thuclucvukhi
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function thuclucvukhi(Request $request)
    {
        $params = $request->all();

        return $this->thuclucvukhiService->searchThuclucvukhi($params);
    }
}