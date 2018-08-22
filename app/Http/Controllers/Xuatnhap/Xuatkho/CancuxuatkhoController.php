<?php


namespace App\Http\Controllers\Xuatnhap\Xuatkho;


use App\Http\Controllers\Controller;
use App\Http\Requests\CancuxuatkhoFormRequest;
use App\Repositories\CancuxuatkhoRepository;
use App\Services\CancuxuatkhoService;
use Response;

class CancuxuatkhoController extends Controller
{
    /**
     * @var CancuxuatkhoRepository
     */
    private $cancuxuatkhoRepository;

    /**
     * @var CancuxuatkhoService
     */
    private $cancuxuatkhoService;

    /**
     * CancuxuatkhoController constructor.
     *
     * @param CancuxuatkhoRepository $cancuxuatkhoRepository
     * @param CancuxuatkhoService $cancuxuatkhoService
     */
    public function __construct(
        CancuxuatkhoRepository $cancuxuatkhoRepository,
        CancuxuatkhoService $cancuxuatkhoService
    ) {
        $this->cancuxuatkhoRepository = $cancuxuatkhoRepository;
        $this->cancuxuatkhoService = $cancuxuatkhoService;
    }

    /**
     * Show all cancuxuatkho
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $danhsachCancuxuatkho = $this->cancuxuatkhoRepository->paginate(config('app.numberPerPage'), ['*'], 'page');

        if ($request->get('page') > $danhsachCancuxuatkho->lastPage()) {
            return redirect()->route('xuatnhap.xuatkho.cancuxuatkho.index');
        }

        if (count($danhsachCancuxuatkho) === 0 && $danhsachCancuxuatkho->currentPage() > 1) {
            return redirect($danhsachCancuxuatkho->previousPageUrl($danhsachCancuxuatkho->currentPage() - 1));
        }

        return view('xuatnhap.xuatkho.cancuxuatkho.index')
            ->with('danhsachCancuxuatkho', $danhsachCancuxuatkho);
    }

    /**
     * Create new a cancuxuatkho
     *
     * @param CancuxuatkhoFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(CancuxuatkhoFormRequest $request)
    {
        $postData = $this->getPostData($request);

        try {
            $this->cancuxuatkhoService->doSave($postData);

            return redirect()->route('xuatnhap.xuatkho.cancuxuatkho.index')
                ->with('add-cancuxuatkho-success', 'Thêm thành công!');
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
        $cancuxuatkho = $this->cancuxuatkhoRepository->findById($id);

        if ($cancuxuatkho === null) {
            return view('xuatnhap.xuatkho.cancuxuatkho.view')
                ->with('notFound', true)
                ->with('id', $id);
        }

        return view('xuatnhap.xuatkho.cancuxuatkho.view')->with('cancuxuatkho', $cancuxuatkho);
    }

    /**
     * Update a cancuxuatkho
     *
     * @param CancuxuatkhoFormRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(CancuxuatkhoFormRequest $request, $id)
    {
        $postData = $this->getPostData($request);

        try {
            $this->cancuxuatkhoService->doUpdate($id, $postData);

            return redirect()->route('xuatnhap.xuatkho.cancuxuatkho.view', $id)
                ->with('update-cancuxuatkho-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a cancuxuatkho by it's ID
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
            $this->cancuxuatkhoService->doDestroy($id);
            return Response::json([], 204);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get post data
     *
     * @param CancuxuatkhoFormRequest $request
     *
     * @return array
     */
    private function getPostData(CancuxuatkhoFormRequest $request)
    {
        return [
            'cancuxuatkho_name' => $request->input('cancuxuatkho_name'),
            'cancuxuatkho_cqralenh' => $request->input('cancuxuatkho_cqralenh'),
            'cancuxuatkho_code' => $request->input('cancuxuatkho_code'),
            'cancuxuatkho_number' => $request->input('cancuxuatkho_number'),
            'cancuxuatkho_date' => $request->input('cancuxuatkho_date'),
            'cancuxuatkho_note' => $request->input('cancuxuatkho_note'),
            'cancuxuatkho_active' => $request->input('cancuxuatkho_active')
        ];
    }
}