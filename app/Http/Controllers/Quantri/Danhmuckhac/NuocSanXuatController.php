<?php


namespace App\Http\Controllers\Quantri\Danhmuckhac;


use App\Http\Controllers\Controller;
use App\Http\Requests\NuocSanXuatFormRequest;
use App\Repositories\HeVuKhiRepository;
use App\Repositories\NuocSanXuatRepository;
use App\Services\NuocSanXuatService;
use Response;

class NuocSanXuatController extends Controller
{
    /**
     * @var NuocSanXuatRepository
     */
    private $nuocSanXuatRepository;

    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * @var NuocSanXuatService
     */
    private $nuocSanXuatService;

    /**
     * NuocSanXuatController constructor.
     *
     * @param NuocSanXuatRepository $nuocSanXuatRepository
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param NuocSanXuatService $nuocSanXuatService
     */
    public function __construct(
        NuocSanXuatRepository $nuocSanXuatRepository,
        HeVuKhiRepository $heVuKhiRepository,
        NuocSanXuatService $nuocSanXuatService
    ) {
        $this->nuocSanXuatRepository = $nuocSanXuatRepository;
        $this->heVuKhiRepository = $heVuKhiRepository;
        $this->nuocSanXuatService = $nuocSanXuatService;
    }

    /**
     * View all countries
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $countries = $this->nuocSanXuatRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $countries->currentPage();

        if ($currentPage > $countries->lastPage()) {
            return redirect()->route('quantri.danhmuckhac.nuocsanxuat.index');
        }

        if (count($countries) === 0 && $currentPage > 1) {
            return redirect($countries->previousPageUrl($currentPage - 1));
        }

        $weaponSystems = $this->heVuKhiRepository->findAll();

        return view('quantri.danhmuckhac.nuocsanxuat.index')
            ->with('countries', $countries)
            ->with('weaponSystems', $weaponSystems->pluck('hevukhi_name', 'hevukhi_id'));
    }

    /**
     * Create new a country
     *
     * @param NuocSanXuatFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(NuocSanXuatFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->nuocSanXuatService->doSave($postData);

            return redirect()->route('quantri.danhmuckhac.nuocsanxuat.index')
                ->with('add-nuocsanxuat-success', 'Thêm thành công!');
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
        $country = $this->nuocSanXuatRepository->findById($id);

        if ($country === null) {
            return view('quantri.danhmuckhac.nuocsanxuat.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        $weaponSystems = $this->heVuKhiRepository->findAll();

        return view('quantri.danhmuckhac.nuocsanxuat.view')
            ->with('country', $country)
            ->with('weaponSystems', $weaponSystems->pluck('hevukhi_name', 'hevukhi_id'));
    }

    /**
     * Update info of country
     *
     * @param NuocSanXuatFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(NuocSanXuatFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->nuocSanXuatService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmuckhac.nuocsanxuat.view', $id)
                ->with('update-nuocsanxuat-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a country by it's ID
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
            $this->nuocSanXuatService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param NuocSanXuatFormRequest $request
     *
     * @return array
     */
    private function getPostData(NuocSanXuatFormRequest $request)
    {
        return [
            'hevukhi_id' => $request->input('hevukhi_id'),
            'nuocsanxuat_name' => $request->input('nuocsanxuat_name'),
            'nuocsanxuat_active' => $request->input('nuocsanxuat_active')
        ];
    }
}