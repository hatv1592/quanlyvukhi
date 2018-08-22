<?php


namespace App\Services;


use App\Http\Controllers\Xuatnhap\XuatnhapLib;
use App\Repositories\DonViRepository;
use App\Repositories\DonViTinhRepository;
use App\Repositories\NuocSanXuatRepository;
use App\Repositories\PhieunhapkhoRepository;
use App\Repositories\VuKhiRepository;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhieunhapkhoService
{
    /**
     * phieunhapkho have status activate
     */
    const ACTIVATE = 1;

    /**
     * phieunhapkho was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * phieu nhap kho
     */
    const IS_NK = 0;

    /**
     * phieu chuyen kho
     */
    const IS_CK = 1;

    /**
     * Level
     */
    const LEVEL = 5;

    /**
     * @var PhieunhapkhoRepository
     */
    private $phieunhapkhoRepository;

    /**
     * @var DonViRepository
     */
    private $donviRepository;

    /**
     * @var DonViTinhRepository
     */
    private $donvitinhRepository;

    /**
     * @var VuKhiRepository
     */
    private $vukhiRepository;

    /**
     * @var NuocSanXuatRepository
     */
    private $nuocsanxuatRepository;

    /**
     * PhieunhapkhoService constructor.
     *
     * @param PhieunhapkhoRepository $phieunhapkhoRepository
     * @param DonViRepository $donviRepository
     * @param DonViTinhRepository $donvitinhRepository
     * @param VuKhiRepository $vukhiRepository
     * @param NuocSanXuatRepository $nuocsanxuatRepository
     */
    public function __construct(
        PhieunhapkhoRepository $phieunhapkhoRepository,
        DonViRepository $donviRepository,
        DonViTinhRepository $donvitinhRepository,
        VuKhiRepository $vukhiRepository,
        NuocSanXuatRepository $nuocsanxuatRepository
    ) {
        $this->phieunhapkhoRepository = $phieunhapkhoRepository;
        $this->donviRepository = $donviRepository;
        $this->donvitinhRepository = $donvitinhRepository;
        $this->vukhiRepository = $vukhiRepository;
        $this->nuocsanxuatRepository = $nuocsanxuatRepository;
    }

    /**
     * Do save a phieunhapkho
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave($postData = [])
    {
        list($phieunhapkhoData, $vukhiData) = $this->handleDataBeforeSave($postData);

        \DB::connection()->getPdo()->beginTransaction();

        try {
            $phieunhapkho = $this->phieunhapkhoRepository->create($phieunhapkhoData);
            foreach ($vukhiData as $vukhi) {
                $phieunhapkho->Phieunhapkhochitiet()->create($vukhi);
            }

            \DB::connection()->getPdo()->commit();
        } catch (\PDOException $e) {
            \DB::connection()->getPdo()->rollBack();
            throw new \PDOException($e->getMessage());
        }
    }

    /**
     * Do update a phieunhapkho
     *
     * @param array $postData
     *
     * @return static
     */
    public function doUpdate($postData = [])
    {
        if (empty($postData['pnk_id'])) {
            throw new NotFoundHttpException("Not found phieunhapkho's ID");
        }

        $phieunhapkho = $this->phieunhapkhoRepository->findById($postData['pnk_id']);
        if ($phieunhapkho === null) {
            throw new NotFoundHttpException("Not found phieunhapkho with id: {$postData['pnk_id']}");
        }

        list($phieunhapkhoData, $vukhiData) = $this->handleDataBeforeSave($postData);

        \DB::connection()->getPdo()->beginTransaction();
        try {
            $this->phieunhapkhoRepository->updateWithAttributes($phieunhapkho, $phieunhapkhoData);

            foreach ($vukhiData as $vukhi) {
                $phieunhapkho->Phieunhapkhochitiet()->create($vukhi);
            }

            \DB::connection()->getPdo()->commit();
        } catch (\PDOException $e) {
            \DB::connection()->getPdo()->rollBack();
            throw new \PDOException($e->getMessage());
        }
    }

    /**
     * Delete a phieunhapkho by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws NotFoundHttpException
     */
    public function doDestroy($id)
    {
        $phieunhapkho = $this->getById($id);

        return $this->phieunhapkhoRepository->delete($phieunhapkho);
    }

    /**
     * Search phieunhapkho
     *
     * @param array $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPhieunhapkho($params = [])
    {
        $conditions = [];

        $this->buildPhieunhapkhoConditions($conditions, $params);

        $total = $this->phieunhapkhoRepository->findByConditions($conditions, $params['item_per_page'], $params['page'], true);
        if ($total === 0) {
            return response()->json([
                'total' => 0,
                'list'  => []
            ]);
        }

        $allPhieunhapkho =  $this->phieunhapkhoRepository->findByConditions($conditions, $params['item_per_page'], $params['page']);

        $dataResponse = $this->formatResponseData($allPhieunhapkho);

        return response()->json([
            'total' => $total,
            'list'  => $dataResponse
        ]);
    }

    /**
     * Initialize for form update
     *
     * @param $id
     * @return mixed
     */
    public function initDataFormUpdate($id)
    {
        $phieunhapkho = $this->phieunhapkhoRepository->findById($id);
        if ($phieunhapkho === null) {
            throw new NotFoundHttpException("Not found phieunhapkho with id: {$id}");
        }

        $data['phieunhapkho'] = [
            'cancunhapkho_id'           => $phieunhapkho->cancunhapkho_id,
            'donvi_id'                  => $phieunhapkho->donvi_id,
            'lydonhapkho_id'            => $phieunhapkho->lydonhapkho_id,
            'donvixuat_name'            => $phieunhapkho->donvixuat_name,
            'pnk_ngay_hethan'           => Carbon::createFromFormat('Y-m-d', $phieunhapkho->pnk_ngay_hethan)->format('d/m/Y'),
            'pnk_donvivanchuyen'        => $phieunhapkho->pnk_donvivanchuyen,
            'pnk_nguoinhanhang'         => $phieunhapkho->pnk_nguoinhanhang,
            'pnk_phuongtienvanchuyen'   => $phieunhapkho->pnk_phuongtienvanchuyen,
            'pnk_nguoinhanphieu'        => $phieunhapkho->pnk_nguoinhanphieu,
            'pnk_nguoiralenh'           => $phieunhapkho->pnk_nguoiralenh,
            'pnk_type'                  => $phieunhapkho->pnk_type
        ];

        $data['pnk_id'] = $id;
        $data['thongtinVukhi'] = [];

        $i = 0;
        $phancap = [];

        foreach ($phieunhapkho->phieunhapkhochitiet as $key => $phieunhapkhochitiet) {
            $vukhiInfo = [
                'vukhi_id' => $phieunhapkhochitiet->vukhi_id,
                'nuocsanxuat_id' => $phieunhapkhochitiet->nuocsanxuat_id,
                'donvitinh_id' => $phieunhapkhochitiet->donvitinh_id,
            ];

            $phancap[$phieunhapkhochitiet->phancap_id] = $phieunhapkhochitiet->soluong_kehoach;

            $i++;

            if ($i === self::LEVEL) {
                if ($vukhiInfo['vukhi_id']) {
                    $vukhiInfo['vukhi'] = $this->vukhiRepository->findById($vukhiInfo['vukhi_id']);

                    $covukhi = $vukhiInfo['vukhi']->covukhi;
                    $vukhiInfo['covukhi_id'] = $covukhi->covukhi_id;

                    $nhomvukhi = $covukhi->nhomvukhi;
                    $vukhiInfo['nhomvukhi_id'] = $nhomvukhi->nhomvukhi_id;

                    $hevukhi = $nhomvukhi->hevukhi;
                    $vukhiInfo['hevukhi_id'] = $hevukhi->hevukhi_id;
                }

                if ($vukhiInfo['nuocsanxuat_id']) {
                    $vukhiInfo['nuocsanxuat'] = $this->nuocsanxuatRepository->findById($vukhiInfo['nuocsanxuat_id']);
                }

                if ($vukhiInfo['donvitinh_id']) {
                    $vukhiInfo['donvitinh'] = $this->donvitinhRepository->findById($vukhiInfo['donvitinh_id']);
                }

                $vukhiInfo['phancap'] = $phancap;

                $data['thongtinVukhi'][] = $vukhiInfo;

                $i = 0;
                $phancap = [];
            }
        }

        return $data;
    }

    /**
     * Format data response
     *
     * @param $allPhieunhapkho
     *
     * @return array
     */
    private function formatResponseData($allPhieunhapkho)
    {
        $dataResponse = [];

        foreach ($allPhieunhapkho as $phieunhapkho) {
            $date = $phieunhapkho->pnk_ngay_thuchien ? explode('-', $phieunhapkho->pnk_ngay_thuchien) : null;

            $dataItem = [
                'id'             => $phieunhapkho->pnk_id,
                'solenh'         => $phieunhapkho->pnk_sophieu,
                'ngaythuchien'   => $date === null || $date[0] === '0000' ? '-' : Carbon::createFromFormat('Y-m-d', $phieunhapkho->pnk_ngay_thuchien)->format('d-m-Y'),
                'donvixuat'      => $phieunhapkho->donvixuat_name,
                'donvinhap'      => is_object($phieunhapkho->DonviNhap) ? $phieunhapkho->DonviNhap->donvi_name : '',
                'lydonhapkho'    => is_object($phieunhapkho->Lydonhapkho) ? $phieunhapkho->Lydonhapkho->lydonhapkho_name : ''
            ];

            $dataResponse[] = $dataItem;
        }

        return $dataResponse;
    }

    /**
     * Build conditions to search for phieunhapkho
     *
     * @param $conditions
     * @param $params
     */
    private function buildPhieunhapkhoConditions(&$conditions, $params)
    {
        if ($params['donvi_id']) {
            $conditions['normal']['donvi_id'] = $params['donvi_id'];
        } else {
            $conditions['normal']['donvi_id'] = 0;
        }

        if ($params['lydonhapkho_id']) {
            $conditions['normal']['lydonhapkho_id'] = $params['lydonhapkho_id'];
        } else {
            $conditions['normal']['lydonhapkho_id'] = 0;
        }

        if ($params['solenh']) {
            $conditions['normal']['pnk_sophieu'] = trim($params['solenh']);
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

    /**
     * Get a phieunhapkho by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function getById($id)
    {
        $phieunhapkho = $this->phieunhapkhoRepository->findById($id);

        if ($phieunhapkho === null) {
            throw new NotFoundHttpException("Phieunhapkho not found with id: {$id}");
        }

        return $phieunhapkho;
    }

    /**
     * Handle post data before save
     *
     * @param $postData
     *
     * @return array
     */
    private function handleDataBeforeSave($postData)
    {
        $phieunhapkhoData = $postData['phieunhapkho'];

        // Check type is PCK or PNK - requirement as coin card
        if ($phieunhapkhoData['pnk_type'] === 'on') {
            $phieunhapkhoData['pnk_type'] = self::IS_CK;
        } else {
            $phieunhapkhoData['pnk_type'] = self::IS_NK;
        }

        $date = Carbon::createFromFormat('d/m/Y', $phieunhapkhoData['pnk_ngay_hethan']);

        // TODO: Should be remove this, because has existed created_at field
        $phieunhapkhoData['pnk_ngay_tao'] = date('Y-m-d');

        $phieunhapkhoData['pnk_ngay_hethan'] = $date->format('Y-m-d');

        $phieunhapkhoData['pnk_status'] = self::NON_ACTIVATE;

        // Do not update pnk_sophieu field when update
        if (empty($postData['pnk_id'])) {
            $this->setSophieuAndCodeForPhieunhapkho($phieunhapkhoData);
        }

        // info of vukhi in phieunhapkho
        $vukhiData = [];
        foreach ($postData['thongtinVukhi'] as $vukhiInfo) {
            foreach ($vukhiInfo['phancap'] as $key => $value) {
                $vukhiData[] = [
                    'vukhi_id'          => $vukhiInfo['vukhi_id'],
                    'nuocsanxuat_id'    => $vukhiInfo['nuocsanxuat_id'],
                    'donvitinh_id'      => $vukhiInfo['donvitinh_id'],
                    'phancap_id'        => $key,
                    'soluong_kehoach'   => $value,
                    'soluong_thucnhap'  => 0
                ];
            }
        }

        return [
            $phieunhapkhoData,
            $vukhiData
        ];
    }

    /**
     * Set data for two fields sophieu and code of phieunhapkho
     *
     * @param array $phieunhapkhoData
     */
    private function setSophieuAndCodeForPhieunhapkho(&$phieunhapkhoData = [])
    {
        $donvi = $this->donviRepository->findById($phieunhapkhoData['donvi_id']);

        if ($donvi === null) {
            throw new NotFoundHttpException("donvi not found with id: {$phieunhapkhoData['donvi_id']}");
        }


        $generateAuto = (new XuatnhapLib())->getAutoCodeImport($donvi->donvi_short_name);

        $phieunhapkhoData['pnk_sophieu'] = $generateAuto['sophieu'];
        $phieunhapkhoData['pnk_code'] = $generateAuto['code'];
    }
}