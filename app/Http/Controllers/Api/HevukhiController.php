<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\HeVuKhiRepository;
use App\Repositories\NhomVuKhiRepository;
use App\Repositories\NuocSanXuatRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class HevukhiController extends Controller
{
    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * @var NhomVuKhiRepository
     */
    private $nhomvukhiRepository;

    /**
     * @var NuocSanXuatRepository
     */
    private $nuocsanxuatRepository;

    /**
     * HevukhiController constructor.
     *
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param NhomVuKhiRepository $nhomvukhiRepository
     * @param NuocSanXuatRepository $nuocsanxuatRepository
     */
    public function __construct(
        HeVuKhiRepository $heVuKhiRepository,
        NhomVuKhiRepository $nhomvukhiRepository,
        NuocSanXuatRepository $nuocsanxuatRepository
    ) {
        $this->heVuKhiRepository = $heVuKhiRepository;
        $this->nhomvukhiRepository = $nhomvukhiRepository;
        $this->nuocsanxuatRepository = $nuocsanxuatRepository;
    }

    /**
     * Get all nhomvukhi via hevukhi by it's ID
     *
     * @param int $hevukhiId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function nhomvukhi($hevukhiId)
    {
        if ((int) $hevukhiId === 0) {
            return response()->json($this->nhomvukhiRepository->findAll());
        }

        $hevukhi = $this->findById($hevukhiId);

        return response()->json($hevukhi->nhomvukhi);
    }


    /**
     * Get all nuocsanxuat via hevukhi by it's ID
     *
     * @param int $hevukhiId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function nuocsanxuat($hevukhiId)
    {
        if ((int) $hevukhiId === 0) {
            return response()->json($this->nuocsanxuatRepository->findAll());
        }

        $hevukhi = $this->findById($hevukhiId);

        return response()->json($hevukhi->nuocsanxuat);
    }

    /**
     * Get a weapon system by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function findById($id)
    {
        $hevukhi = $this->heVuKhiRepository->findById($id);

        if ($hevukhi === null) {
            throw new InternalErrorException('Weapon system not found with ID: ' . $id);
        }

        return $hevukhi;
    }
}