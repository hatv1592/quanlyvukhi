<?php


namespace App\Http\Controllers\Quantri\Danhmucvukhi;


use App\Http\Controllers\Controller;
use App\Http\Requests\VuKhiFormRequest;
use App\Repositories\CoVuKhiRepository;
use App\Repositories\VuKhiRepository;
use App\Services\VuKhiService;
use Response;

class VuKhiController extends Controller
{
    /**
     * @var VuKhiRepository
     */
    private $vuKhiRepository;

    /**
     * @var CoVuKhiRepository
     */
    private $coVuKhiRepository;

    /**
     * @var VuKhiService
     */
    private $vuKhiService;

    /**
     * VuKhiController constructor.
     *
     * @param VuKhiRepository $vuKhiRepository
     * @param CoVuKhiRepository $coVuKhiRepository
     * @param VuKhiService $vuKhiService
     */
    public function __construct(
        VuKhiRepository $vuKhiRepository,
        CoVuKhiRepository $coVuKhiRepository,
        VuKhiService $vuKhiService
    ) {
        $this->vuKhiRepository = $vuKhiRepository;
        $this->coVuKhiRepository = $coVuKhiRepository;
        $this->vuKhiService = $vuKhiService;
    }

    /**
     * View all weapon screen
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $weapons = $this->vuKhiRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $weapons->currentPage();

        if ($currentPage > $weapons->lastPage()) {
            return redirect()->route('quantri.danhmucvukhi.vukhi.index');
        }

        if (count($weapons) === 0 && $currentPage > 1) {
            return redirect($weapons->previousPageUrl($currentPage - 1));
        }

        $weaponSizes = $this->coVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.vukhi.index')
            ->with('weapons', $weapons)
            ->with('weaponSizes', $weaponSizes->pluck('covukhi_name', 'covukhi_id'));
    }

    /**
     * Create new a weapon
     *
     * @param VuKhiFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(VuKhiFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->vuKhiService->doSave($postData);

            return redirect()->route('quantri.danhmucvukhi.vukhi.index')
                ->with('add-vukhi-success', 'Thêm thành công!');
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
        $weapon = $this->vuKhiRepository->findById($id);

        if ($weapon === null) {
            return view('quantri.danhmucvukhi.vukhi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        $weaponSizes = $this->coVuKhiRepository->findAll();

        return view('quantri.danhmucvukhi.vukhi.view')
            ->with('weapon', $weapon)
            ->with('weaponSizes', $weaponSizes->pluck('covukhi_name', 'covukhi_id'));
    }

    /**
     * Update a weapon
     *
     * @param VuKhiFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(VuKhiFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->vuKhiService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmucvukhi.vukhi.view', $id)
                ->with('update-vukhi-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a weapon by it's ID
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
            $this->vuKhiService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param VuKhiFormRequest $request
     *
     * @return array
     */
    private function getPostData(VuKhiFormRequest $request)
    {
        return [
            'covukhi_id' => $request->input('covukhi_id'),
            'vukhi_code' => $request->input('vukhi_code'),
            'vukhi_name' => $request->input('vukhi_name'),
            'vukhi_kyhieu' => $request->input('vukhi_kyhieu'),
            'vukhi_trongluong' => $request->input('vukhi_trongluong'),
            'vukhi_dai' => $request->input('vukhi_dai'),
            'vukhi_rong' => $request->input('vukhi_rong'),
            'vukhi_cao' => $request->input('vukhi_cao'),
            'vukhi_active' => $request->input('vukhi_active')
        ];
    }
}