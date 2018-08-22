<?php


namespace App\Http\Controllers\Quantri\Danhmucvukhi;


use App\Http\Controllers\Controller;
use App\Http\Requests\CoVuKhiFormRequest;
use App\Repositories\CoVuKhiRepository;
use App\Repositories\NhomVuKhiRepository;
use App\Services\CoVuKhiService;
use Response;

class CoVuKhiController extends Controller
{
    /**
     * @var CoVuKhiRepository
     */
    private $coVuKhiRepository;

    /**
     * @var NhomVuKhiRepository
     */
    private $nhomVuKhiRepository;

    /**
     * @var CoVuKhiService
     */
    private $coVuKhiService;

    /**
     * NhomVuKhiController constructor.
     *
     * @param CoVuKhiRepository $coVuKhiRepository
     * @param NhomVuKhiRepository $nhomVuKhiRepository
     * @param CoVuKhiService $coVuKhiService
     */
    public function __construct(
        CoVuKhiRepository $coVuKhiRepository,
        NhomVuKhiRepository $nhomVuKhiRepository,
        CoVuKhiService $coVuKhiService
    ) {
        $this->coVuKhiRepository = $coVuKhiRepository;
        $this->nhomVuKhiRepository = $nhomVuKhiRepository;
        $this->coVuKhiService = $coVuKhiService;
    }

    /**
     * View all covukhi screen
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $weaponSizes = $this->coVuKhiRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $weaponSizes->currentPage();

        if ($currentPage > $weaponSizes->lastPage()) {
            return redirect()->route('quantri.danhmucvukhi.covukhi.index');
        }

        if (count($weaponSizes) === 0 && $currentPage > 1) {
            return redirect($weaponSizes->previousPageUrl($currentPage - 1));
        }

        $weaponGroups = $this->nhomVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.covukhi.index')
            ->with('weaponSizes', $weaponSizes)
            ->with('weaponGroups', $weaponGroups->pluck('nhomvukhi_name', 'nhomvukhi_id'));
    }

    /**
     * Create new a weapon size
     *
     * @param CoVuKhiFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(CoVuKhiFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->coVuKhiService->doSave($postData);

            return redirect()->route('quantri.danhmucvukhi.covukhi.index')
                ->with('add-covukhi-success', 'Thêm thành công!');
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
        $weaponSize = $this->coVuKhiRepository->findById($id);

        if ($weaponSize === null) {
            return view('quantri.danhmucvukhi.covukhi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        $weaponGroups = $this->nhomVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.covukhi.view')
            ->with('weaponSize', $weaponSize)
            ->with('weaponGroups', $weaponGroups->pluck('nhomvukhi_name', 'nhomvukhi_id'));
    }

    /**
     * Update a covukhi
     *
     * @param CoVuKhiFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(CoVuKhiFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->coVuKhiService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmucvukhi.covukhi.view', $id)
                ->with('update-covukhi-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a covukhi by it's ID
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
            $this->coVuKhiService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param CoVuKhiFormRequest $request
     *
     * @return array
     */
    private function getPostData(CoVuKhiFormRequest $request)
    {
        return [
            'nhomvukhi_id' => $request->input('nhomvukhi_id'),
            'covukhi_code' => $request->input('covukhi_code'),
            'covukhi_name' => $request->input('covukhi_name'),
            'covukhi_active' => $request->input('covukhi_active')
        ];
    }
}