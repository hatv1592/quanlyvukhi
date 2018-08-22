<?php


namespace App\Http\Controllers\Quantri\Danhmuckhac;


use App\Http\Controllers\Controller;
use App\Http\Requests\DonViTinhFormRequest;
use App\Repositories\DonViTinhRepository;
use App\Services\DonViTinhService;
use Response;

class DonViTinhController extends Controller
{
    /**
     * @var DonViTinhRepository
     */
    private $donViTinhRepository;

    /**
     * @var DonViTinhService
     */
    private $donViTinhService;

    /**
     * DonViController constructor.
     *
     * @param DonViTinhRepository $donViTinhRepository
     * @param DonViTinhService $donViTinhService
     */
    public function __construct(
        DonViTinhRepository $donViTinhRepository,
        DonViTinhService $donViTinhService
    ) {
        $this->donViTinhRepository = $donViTinhRepository;
        $this->donViTinhService = $donViTinhService;
    }

    /**
     * View all calculation unit screen
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $calculationUnit = $this->donViTinhRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        $currentPage = $calculationUnit->currentPage();

        if ($currentPage > $calculationUnit->lastPage()) {
            return redirect()->route('quantri.danhmuckhac.donvitinh.index');
        }

        if (count($calculationUnit) === 0 && $currentPage > 1) {
            return redirect($calculationUnit->previousPageUrl($currentPage - 1));
        }

        return view('quantri.danhmuckhac.donvitinh.index')->with('calculationUnit', $calculationUnit);
    }

    /**
     * Create new a calculation unit
     *
     * @param DonViTinhFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(DonViTinhFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->donViTinhService->doSave($postData);

            return redirect()->route('quantri.danhmuckhac.donvitinh.index')
                ->with('add-donvitinh-success', 'Thêm thành công!');
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
        $calculationUnit = $this->donViTinhRepository->findById($id);

        if ($calculationUnit === null) {
            return view('quantri.danhmuckhac.donvitinh.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        return view('quantri.danhmuckhac.donvitinh.view')
            ->with('calculationUnit', $calculationUnit);
    }

    /**
     * Update a calculation unit
     *
     * @param DonViTinhFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(DonViTinhFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->donViTinhService->doUpdate($id, $postData);

            return redirect()->route('quantri.danhmuckhac.donvitinh.view', $id)
                ->with('update-donvitinh-success', 'Cập nhật thành công!');
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
            $this->donViTinhService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param DonViTinhFormRequest $request
     *
     * @return array
     */
    private function getPostData(DonViTinhFormRequest $request)
    {
        return [
            'donvitinh_name' => $request->input('donvitinh_name'),
            'donvitinh_active' => $request->input('donvitinh_active')
        ];
    }
}