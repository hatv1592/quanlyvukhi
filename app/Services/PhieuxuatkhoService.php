<?php


namespace App\Services;


use App\Repositories\PhieuxuatkhoRepository;
use Carbon\Carbon;

class PhieuxuatkhoService
{
    /**
     * @var PhieuxuatkhoRepository
     */
    private $phieuxuatkhoRepository;

    /**
     * PhieuxuatkhoService constructor.
     *
     * @param PhieuxuatkhoRepository $phieuxuatkhoRepository
     */
    public function __construct(PhieuxuatkhoRepository $phieuxuatkhoRepository)
    {
        $this->phieuxuatkhoRepository = $phieuxuatkhoRepository;
    }

    /**
     * Search phieuxuatkho
     *
     * @param array $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPhieuxuatkho($params = [])
    {
        $conditions = [];

        $this->buildPhieuxuatkhoConditions($conditions, $params);

        $total = $this->phieuxuatkhoRepository->findByConditions($conditions, $params['item_per_page'], $params['page'], true);
        if ($total === 0) {
            return response()->json([
                'total' => 0,
                'list'  => []
            ]);
        }

        $allPhieuxuatkho =  $this->phieuxuatkhoRepository->findByConditions($conditions, $params['item_per_page'], $params['page']);

        $dataResponse = $this->formatResponseData($allPhieuxuatkho);

        return response()->json([
            'total' => $total,
            'list'  => $dataResponse
        ]);
    }

    /**
     * Format data response
     *
     * @param $allPhieuxuatkho
     *
     * @return array
     */
    private function formatResponseData($allPhieuxuatkho)
    {
        $dataResponse = [];

        foreach ($allPhieuxuatkho as $phieuxuatkho) {
            $date = $phieuxuatkho->pxk_ngay_thuchien ? explode('-', $phieuxuatkho->pxk_ngay_thuchien) : null;

            $dataItem = [
                'id'             => $phieuxuatkho->pxk_id,
                'solenh'         => $phieuxuatkho->pxk_sophieu,
                'ngaythuchien'   => $date == null || $date[0] === '0000' ? '-' : Carbon::createFromFormat('Y-m-d', $phieuxuatkho->pxk_ngay_thuchien)->format('d-m-Y'),
                'donvinhap'      => $phieuxuatkho->donvinhap_name,
                'donvixuat'      => is_object($phieuxuatkho->donvixuat) ? $phieuxuatkho->donvixuat->donvi_name : '',
                'lydoxuatkho'    => is_object($phieuxuatkho->Lydoxuatkho) ? $phieuxuatkho->Lydoxuatkho->lydoxuatkho_name : ''
            ];

            $dataResponse[] = $dataItem;
        }

        return $dataResponse;
    }

    /**
     * Build conditions to search for phieuxuatkho
     *
     * @param $conditions
     * @param $params
     */
    private function buildPhieuxuatkhoConditions(&$conditions, $params)
    {
        if ($params['donvi_id']) {
            $conditions['normal']['donvixuat_id'] = (int)$params['donvi_id'];
        } else {
            $conditions['normal']['donvixuat_id'] = 0;
        }

        if ($params['lydoxuatkho_id']) {
            $conditions['normal']['lydoxuatkho_id'] = (int)$params['lydoxuatkho_id'];
        } else {
            $conditions['normal']['lydoxuatkho_id'] = 0;
        }

        if ($params['solenh']) {
            $conditions['normal']['pxk_sophieu'] = trim($params['solenh']);
        }

        if ($params['from_date']) {
            $date = \DateTime::createFromFormat('d-m-Y', $params['from_date']);
            $conditions['date']['from_date'] = $date->format('Y-m-d') . ' 00:00:00';
        }

        if ($params['to_date']) {
            $date = \DateTime::createFromFormat('d-m-Y', $params['to_date']);
            $conditions['date']['to_date'] = $date->format('Y-m-d') . ' 00:00:00';
        }
    }
}