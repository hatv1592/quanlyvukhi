<?php


namespace App\Services;


use App\Repositories\ThuclucvukhiRepository;

class ThuclucvukhiService
{
    /**
     * @var ThuclucvukhiRepository
     */
    private $thuclucvukhiRepository;

    /**
     * ThuclucvukhiService constructor.
     *
     * @param ThuclucvukhiRepository $thuclucvukhiRepository
     */
    public function __construct(ThuclucvukhiRepository $thuclucvukhiRepository)
    {
        $this->thuclucvukhiRepository = $thuclucvukhiRepository;
    }

    /**
     * Search all thuclucvukhi by conditions
     *
     * @param array $params
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchThuclucvukhi($params = [])
    {
        $conditions = [];

        $this->buildVukhiConditions($conditions, $params);

        $total = $this->thuclucvukhiRepository->findByConditions($conditions, $params['item_per_page'], $params['page'], true);
        if ($total === 0) {
            return response()->json([
                'total' => 0,
                'list'  => []
            ]);
        }

        $allThuclucvukhi =  $this->thuclucvukhiRepository->findByConditions($conditions, $params['item_per_page'], $params['page']);

        $dataResponse = $this->formatResponseData($allThuclucvukhi);

        return response()->json([
            'total' => $total,
            'list'  => $dataResponse
        ]);
    }

    /**
     * Format data response
     *
     * @param $dataThuclucvukhiFilters
     *
     * @return array
     */
    private function formatResponseData($dataThuclucvukhiFilters)
    {
        $dataResponse = [];

        foreach ($dataThuclucvukhiFilters as $thuclucvukhi) {
            $dataItem = [
                'id'            => $thuclucvukhi->thuclucvukhi_id,
                'vukhi'         => is_object($thuclucvukhi->vukhi) ? $thuclucvukhi->vukhi->vukhi_name : '',
                'nuocsanxuat'   => is_object($thuclucvukhi->nuocsanxuat) ? $thuclucvukhi->nuocsanxuat->nuocsanxuat_name : '',
                'donvitinh'     => is_object($thuclucvukhi->donvitinh) ? $thuclucvukhi->donvitinh->donvitinh_name : '',
                'donvi'         => is_object($thuclucvukhi->donvi) ? $thuclucvukhi->donvi->donvi_name : '',
            ];

            $levels = [];
            foreach ($thuclucvukhi->thuclucvukhichitiet as $item) {
                $levels['level_' . $item->phancap_id] = $item->soluong;
            }

            $dataItem['level'] = $levels;

            $dataResponse[] = $dataItem;
        }

        return $dataResponse;
    }

    /**
     * Build conditions of vukhi
     *
     * @param $conditions
     * @param $params
     */
    private function buildVukhiConditions(&$conditions, $params)
    {
        if ($params['donvi_id'] || (int) $params['donvi_id'] === 0) {
            $conditions['donvi_id'] = $params['donvi_id'];
        }

        if ($params['hevukhi_id'] || (int) $params['hevukhi_id'] === 0) {
            $conditions['hevukhi_id'] = $params['hevukhi_id'];
        }

        if ($params['vukhi_id'] || (int) $params['vukhi_id'] === 0) {
            $conditions['vukhi_id'] = $params['vukhi_id'];
        }

        if ($params['nhomvukhi_id'] || (int) $params['nhomvukhi_id'] === 0) {
            $conditions['nhomvukhi_id'] = $params['nhomvukhi_id'];
        }

        if ($params['covukhi_id'] || (int) $params['covukhi_id'] === 0) {
            $conditions['covukhi_id'] = $params['covukhi_id'];
        }

        if ($params['donvitinh_id'] || (int) $params['donvitinh_id'] === 0) {
            $conditions['donvitinh_id'] = $params['donvitinh_id'];
        }

        if ($params['nuocsanxuat_id'] || (int) $params['nuocsanxuat_id'] === 0) {
            $conditions['nuocsanxuat_id'] = $params['nuocsanxuat_id'];
        }
    }
}