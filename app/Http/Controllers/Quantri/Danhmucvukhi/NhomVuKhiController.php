<?php


namespace App\Http\Controllers\Quantri\Danhmucvukhi;


use App\Http\Controllers\Controller;
use App\Http\Requests\NhomVuKhiFormRequest;
use App\Repositories\HeVuKhiRepository;
use App\Repositories\NhomVuKhiRepository;
use App\Services\NhomVuKhiService;
use Response;

class NhomVuKhiController extends Controller
{
    /**
     * @var NhomVuKhiRepository
     */
    private $nhomVuKhiRepository;

    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * @var NhomVuKhiService
     */
    private $nhomVuKhiService;

    /**
     * NhomVuKhiController constructor.
     *
     * @param NhomVuKhiRepository $nhomVuKhiRepository
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param NhomVuKhiService $nhomVuKhiService
     */
    public function __construct(
        NhomVuKhiRepository $nhomVuKhiRepository,
        HeVuKhiRepository $heVuKhiRepository,
        NhomVuKhiService $nhomVuKhiService
    ) {
        $this->nhomVuKhiRepository = $nhomVuKhiRepository;
        $this->heVuKhiRepository = $heVuKhiRepository;
        $this->nhomVuKhiService = $nhomVuKhiService;
    }

    /**
     * View all nhomvukhi screen
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $weaponGroups = $this->nhomVuKhiRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $weaponGroups->currentPage();

        if ($currentPage > $weaponGroups->lastPage()) {
            return redirect()->route('quantri.danhmucvukhi.nhomvukhi.index');
        }

        if (count($weaponGroups) === 0 && $currentPage > 1) {
            return redirect($weaponGroups->previousPageUrl($currentPage - 1));
        }

        $weapons = $this->heVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.nhomvukhi.index')
            ->with('weaponGroups', $weaponGroups)
            ->with('weapons', $weapons->pluck('hevukhi_name', 'hevukhi_id'));
    }

    /**
     * Create new a weapon group
     *
     * @param NhomVuKhiFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(NhomVuKhiFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->nhomVuKhiService->doSave($postData);

            return redirect()->route('quantri.danhmucvukhi.nhomvukhi.index')
                ->with('add-nhomvukhi-success', 'Thêm thành công!');
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
        $weaponGroup = $this->nhomVuKhiRepository->findById($id);

        if ($weaponGroup === null) {
            return view('quantri.danhmucvukhi.nhomvukhi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        $weapons = $this->heVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.nhomvukhi.view')
            ->with('weaponGroup', $weaponGroup)
            ->with('weapons', $weapons->pluck('hevukhi_name', 'hevukhi_id'));
    }

    /**
     * Update a nhomvukhi
     *
     * @param NhomVuKhiFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(NhomVuKhiFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->nhomVuKhiService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmucvukhi.nhomvukhi.view', $id)
                ->with('update-nhomvukhi-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a nhomvukhi by it's ID
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
            $this->nhomVuKhiService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param NhomVuKhiFormRequest $request
     *
     * @return array
     */
    private function getPostData(NhomVuKhiFormRequest $request)
    {
        return [
            'hevukhi_id' => $request->input('hevukhi_id'),
            'nhomvukhi_code' => $request->input('nhomvukhi_code'),
            'nhomvukhi_name' => $request->input('nhomvukhi_name'),
            'nhomvukhi_active' => $request->input('nhomvukhi_active')
        ];
    }
}