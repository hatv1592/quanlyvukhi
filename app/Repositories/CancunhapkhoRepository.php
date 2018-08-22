<?php


namespace App\Repositories;


use App\Model\Xuatnhap\CancunhapkhoModel;

class CancunhapkhoRepository
{
    /**
     * @var CancunhapkhoModel
     */
    private $model;

    /**
     * CancunhapkhoRepository constructor.
     *
     * @param CancunhapkhoModel $model
     */
    public function __construct(CancunhapkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find all cancunhapkho
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find all cancunhapkho where active like 1
     *
     * @return mixed
     */
    public function findAllActive()
    {
        return $this->model->where('cancunhapkho_active', 1)->get();
    }

    /**
     * Find a cancunhapkho by it's ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Paginated list of cancunhapkho
     *
     * @param $numberPerPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($numberPerPage, array $columns, $pageName = 'page', $page = null)
    {
        return $this->model
            ->orderBy('cancunhapkho_id', 'desc')
            ->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new a cancunhapkho
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Delete a cancunhapkho by it's ID
     *
     * @param CancunhapkhoModel $cancunhapkho
     *
     * @return bool|null
     */
    public function delete(CancunhapkhoModel $cancunhapkho)
    {
        return $cancunhapkho->delete();
    }

    /**
     * Update info of a cancunhapkho
     *
     * @param CancunhapkhoModel $cancunhapkho
     *
     * @return bool
     */
    public function update(CancunhapkhoModel $cancunhapkho)
    {
        return $cancunhapkho->save();
    }
}