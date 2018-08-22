<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\CoVuKhiRepository;
use App\Repositories\NhomVuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class NhomvukhiController extends Controller
{
    /**
     * @var NhomVuKhiRepository
     */
    private $nhomVuKhiRepository;

    /**
     * @var CoVuKhiRepository
     */
    private $covukhiRepository;

    /**
     * NhomvukhiController constructor.
     *
     * @param NhomVuKhiRepository $heVuKhiRepository
     * @param CoVuKhiRepository $covukhiRepository
     */
    public function __construct(
        NhomVuKhiRepository $heVuKhiRepository,
        CoVuKhiRepository $covukhiRepository
    ) {
        $this->nhomVuKhiRepository = $heVuKhiRepository;
        $this->covukhiRepository = $covukhiRepository;
    }

    /**
     * Get all covukhi via nhomvukhi by it's ID
     *
     * @param int $nhomvukhiId
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws InternalErrorException
     */
    public function covukhi($nhomvukhiId)
    {
        if ((int) $nhomvukhiId === 0) {
            return response()->json($this->covukhiRepository->findAll());
        }

        $nhomvukhi = $this->nhomVuKhiRepository->findById($nhomvukhiId);

        if ($nhomvukhi === null) {
            throw new InternalErrorException('Weapon group not found with ID: ' . $nhomvukhiId);
        }

        return response()->json($nhomvukhi->covukhi);
    }
}