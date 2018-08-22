<?php


namespace App\Http\Controllers\Quantri\Danhmucvukhi;


use App\Http\Requests\HeVuKhiFormRequest;
use App\Services\HeVuKhiService;
use App\Http\Controllers\Controller;
use App\Repositories\HeVuKhiRepository;
use \Illuminate\Http\Request;
use Response;


class HeVuKhiController extends Controller
{
    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * @var HeVuKhiService
     */
    private $heVuKhiService;

    /**
     * HeVuKhiController constructor.
     *
     * @param HeVuKhiRepository $heVuKhiRepository
     * @param HeVuKhiService $heVuKhiService
     */
    public function __construct(
        HeVuKhiRepository $heVuKhiRepository,
        HeVuKhiService $heVuKhiService
    ) {
        $this->heVuKhiRepository = $heVuKhiRepository;
        $this->heVuKhiService = $heVuKhiService;
    }

    /**
     * Display a all weapons.
     *
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        $weapons = $this->heVuKhiRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        if ($request->get('page') > $weapons->lastPage()) {
            return redirect()->route('quantri.danhmucvukhi.hevukhi.index');
        }

        if (count($weapons) === 0 && $weapons->currentPage() > 1) {
            return redirect($weapons->previousPageUrl($weapons->currentPage() - 1));
        }

        return view('quantri.danhmucvukhi.hevukhi.index')
            ->with('weapons', $weapons);
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
        $weapon = $this->heVuKhiRepository->findById($id);

        if ($weapon === null) {
            return view('quantri.danhmucvukhi.hevukhi.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        return view('quantri.danhmucvukhi.hevukhi.view')->with('weapon', $weapon);
    }

    /**
     * Create new a weapon
     *
     * @param HeVuKhiFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(HeVuKhiFormRequest $request)
    {
        $postData = [
            'hevukhi_code' => $request->input('hevukhi_code'),
            'hevukhi_name' => $request->input('hevukhi_name'),
            'hevukhi_active' => $request->input('hevukhi_active')
        ];

        try {
            $this->heVuKhiService->doSave($postData);

            return redirect()->route('quantri.danhmucvukhi.hevukhi.index')
                ->with('add-hevukhi-success', 'Thêm thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a hevukhi by it's ID
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
            $this->heVuKhiService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Update hevukhi
     *
     * @param HeVuKhiFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(HeVuKhiFormRequest $request, $id)
    {
        $postData = [
            'hevukhi_code' => $request->input('hevukhi_code'),
            'hevukhi_name' => $request->input('hevukhi_name'),
            'hevukhi_active' => $request->input('hevukhi_active')
        ];

        try {
            $this->heVuKhiService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmucvukhi.hevukhi.view', $id)
                ->with('update-hevukhi-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}