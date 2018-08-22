<?php


namespace App\Http\Controllers\Xuatnhap\Nhapkho;


use App\Http\Controllers\Controller;
use App\Http\Requests\CancunhapkhoFormRequest;
use App\Repositories\CancunhapkhoRepository;
use App\Services\CancunhapkhoService;
use Response;

class CancunhapkhoController extends Controller
{
    /**
     * @var CancunhapkhoRepository
     */
    private $cancunhapkhoRepository;

    /**
     * @var CancunhapkhoService
     */
    private $cancunhapkhoService;

    /**
     * CancunhapkhoController constructor.
     *
     * @param CancunhapkhoRepository $cancunhapkhoRepository
     * @param CancunhapkhoService $cancunhapkhoService
     */
    public function __construct(
        CancunhapkhoRepository $cancunhapkhoRepository,
        CancunhapkhoService $cancunhapkhoService
    ) {
        $this->cancunhapkhoRepository = $cancunhapkhoRepository;
        $this->cancunhapkhoService = $cancunhapkhoService;
    }

    /**
     * Show all Cancunhapkho
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $danhsachCancunhapkho = $this->cancunhapkhoRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        if ($request->get('page') > $danhsachCancunhapkho->lastPage()) {
            return redirect()->route('xuatnhap.nhapkho.cancunhapkho.index');
        }

        if (count($danhsachCancunhapkho) === 0 && $danhsachCancunhapkho->currentPage() > 1) {
            return redirect($danhsachCancunhapkho->previousPageUrl($danhsachCancunhapkho->currentPage() - 1));
        }

        return view('xuatnhap.nhapkho.cancunhapkho.index')
            ->with('danhsachCancunhapkho', $danhsachCancunhapkho);
    }

    /**
     * Create new a Cancunhapkho
     *
     * @param CancunhapkhoFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(CancunhapkhoFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->cancunhapkhoService->doSave($postData);

            return redirect()->route('xuatnhap.nhapkho.cancunhapkho.index')
                ->with('add-cancunhapkho-success', 'Thêm thành công!');
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
        $cancunhapkho = $this->cancunhapkhoRepository->findById($id);

        if ($cancunhapkho === null) {
            return view('xuatnhap.nhapkho.cancunhapkho.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        return view('xuatnhap.nhapkho.cancunhapkho.view')->with('cancunhapkho', $cancunhapkho);
    }

    /**
     * Update a Cancunhapkho
     *
     * @param CancunhapkhoFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(CancunhapkhoFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->cancunhapkhoService->doUpdate($id, $postData);

            return redirect()->route('xuatnhap.nhapkho.cancunhapkho.view', $id)
                ->with('update-cancunhapkho-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a Cancunhapkho by it's ID
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
            $this->cancunhapkhoService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param CancunhapkhoFormRequest $request
     *
     * @return array
     */
    private function getPostData(CancunhapkhoFormRequest $request)
    {
        return [
            'cancunhapkho_name' => $request->input('cancunhapkho_name'),
            'cancunhapkho_coquan' => $request->input('cancunhapkho_coquan'),
            'cancunhapkho_code' => $request->input('cancunhapkho_code'),
            'cancunhapkho_number' => $request->input('cancunhapkho_number'),
            'cancunhapkho_date' => $request->input('cancunhapkho_date'),
            'cancunhapkho_note' => $request->input('cancunhapkho_note'),
            'cancunhapkho_active' => $request->input('cancunhapkho_active')
        ];
    }
}