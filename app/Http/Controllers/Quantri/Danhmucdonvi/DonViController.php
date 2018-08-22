<?php


namespace App\Http\Controllers\Quantri\Danhmucdonvi;


use App\Http\Controllers\Controller;
use App\Http\Requests\DonViFormRequest;
use App\Repositories\DonViRepository;
use App\Services\DonViService;
use Response;

class DonViController extends Controller
{
    /**
     * @var DonViRepository
     */
    private $donViRepository;

    /**
     * @var DonViService
     */
    private $donViService;

    /**
     * DonViController constructor.
     *
     * @param DonViRepository $donViRepository
     * @param DonViService $donViService
     */
    public function __construct(
        DonViRepository $donViRepository,
        DonViService $donViService
    )
    {
        $this->donViRepository = $donViRepository;
        $this->donViService = $donViService;
    }

    /**
     * View all units
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $units = $this->donViRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $units->currentPage();

        if ($currentPage > $units->lastPage()) {
            return redirect()->route('quantri.danhmucdonvi.donvi.index');
        }

        if (count($units) === 0 && $currentPage > 1) {
            return redirect($units->previousPageUrl($currentPage - 1));
        }

        $parentUnits = $this->donViRepository->findAllParent();

        return view('quantri.danhmucdonvi.donvi.index')
            ->with('units', $units)
            ->with('parentUnits', $parentUnits->pluck('donvi_name', 'donvi_id'))
            ->with('parentIdDonvi', $request->get('parent_id_donvi'));
    }

    /**
     * Create new a calculation unit
     *
     * @param DonViFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(DonViFormRequest $request)
    {
        $postData = $this->getPostData($request);
        try {
            $this->donViService->doSave($postData);

            return redirect()->route('quantri.danhmucdonvi.donvi.index')
                ->with('add-donvi-success', 'Thêm thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Edit screen
     *
     * @param int $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $unit = $this->donViRepository->findById($id);

        if ($unit === null) {
            return view('quantri.danhmucdonvi.donvi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        $parentUnits = $this->donViRepository->findAllParent();

        return view('quantri.danhmucdonvi.donvi.view')
            ->with('unit', $unit)
            ->with('parentUnits', $parentUnits->pluck('donvi_name', 'donvi_id'));
    }


    /**
     * Show all weapon of donvi
     *
     * @param int $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function detail($id)
    {
        $unit = $this->donViRepository->findById($id);
        if ($unit === null) {
            return view('quantri.danhmucdonvi.donvi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }
        $thucLucVuKhi = [];
        $thucLucVuKhiChiTiet = [];
        $parentUnits = $this->donViRepository->findAllParent();
        $thucLucVuKhi = $this->donViRepository->findAllWeaponByDonviId($id);
        $listThucLucVuKhiIds = $thucLucVuKhi->pluck('thuclucvukhi_id');
        $thucLucVuKhiChiTiet = $this->donViRepository->findAllWeaponNumberByWeaponIds($listThucLucVuKhiIds);

        $soLuong = array();
        if (count($thucLucVuKhiChiTiet) > 0) {
            foreach ($thucLucVuKhiChiTiet as $key => $ct_val) {
                $soLuong[$ct_val->thuclucvukhi_id][$ct_val->phancap_id] = $ct_val->soluong;
                unset($thucLucVuKhiChiTiet[$key]);
            }
        }

        return view('quantri.danhmucdonvi.donvi.detail')
            ->with('unit', $unit)
            ->with('arrThucLucVuKhi', $thucLucVuKhi)
            ->with('arrDonVi', $id)
            ->with('arrSoLuong', $soLuong)
            ->with('parentUnits', $parentUnits->pluck('donvi_name', 'donvi_id'));
    }

    /**
     * Update a calculation unit
     *
     * @param DonViFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(DonViFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->donViService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmucdonvi.donvi.view', $id)
                ->with('update-donvi-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a calculation unit by it's ID
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $this->donViService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param DonViFormRequest $request
     *
     * @return array
     */
    private function getPostData(DonViFormRequest $request)
    {
        return [
            'donvi_name' => $request->input('donvi_name'),
            'donvi_short_name' => $request->input('donvi_short_name'),
            'donvi_parent' => $request->input('donvi_parent'),
        ];

    }
}