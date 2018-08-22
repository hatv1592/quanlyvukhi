<?php


namespace App\Repositories;


use App\Model\Xuatnhap\CancuxuatkhoModel;

class CancuxuatkhoRepository
{
    /**
     * @var CancuxuatkhoModel
     */
    private $model;

    /**
     * CancuxuatkhoRepository constructor.
     *
     * @param CancuxuatkhoModel $model
     */
    public function __construct(CancuxuatkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a cancuxuatkho by it's ID
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
     * Paginated list of cancuxuatkho
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
            ->orderBy('cancuxuatkho_id', 'desc')
            ->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new a cancuxuatkho
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
     * Delete a cancuxuatkho size by it's ID
     *
     * @param CancuxuatkhoModel $cancuxuatkho
     *
     * @return bool|null
     */
    public function delete(CancuxuatkhoModel $cancuxuatkho)
    {
        return $cancuxuatkho->delete();
    }

    /**
     * Update info of a cancuxuatkho
     *
     * @param CancuxuatkhoModel $cancuxuatkho
     *
     * @return bool
     */
    public function update(CancuxuatkhoModel $cancuxuatkho)
    {
        return $cancuxuatkho->save();
    }
}