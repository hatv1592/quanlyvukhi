<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\CoVuKhiRepository;
use App\Repositories\VuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CovukhiController extends Controller
{
    /**
     * @var CoVuKhiRepository
     */
    private $coVuKhiRepository;

    /**
     * @var VuKhiRepository
     */
    private $vukhiRepository;

    /**
     * CovukhiController constructor.
     *
     * @param CoVuKhiRepository $coVuKhiRepository
     * @param VuKhiRepository $vukhiRepository
     */
    public function __construct(
        CoVuKhiRepository $coVuKhiRepository,
        VuKhiRepository $vukhiRepository
    ) {
        $this->coVuKhiRepository = $coVuKhiRepository;
        $this->vukhiRepository = $vukhiRepository;
    }

    /**
     * Get all weapons via weaponSize by it's ID
     *
     * @param int $covukhiId
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws InternalErrorException
     */
    public function vukhi($covukhiId)
    {
        if ((int) $covukhiId === 0) {
            return response()->json($this->vukhiRepository->findAll());
        }

        $covukhi = $this->coVuKhiRepository->findById($covukhiId);

        if ($covukhi === null) {
            throw new InternalErrorException('Weapon size not found with ID: ' . $covukhiId);
        }

        return response()->json($covukhi->vukhi);
    }
}