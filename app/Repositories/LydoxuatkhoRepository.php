<?php


namespace App\Repositories;


use App\Model\LydoxuatkhoModel;

class LydoxuatkhoRepository
{
    /**
     * @var LydoxuatkhoModel
     */
    private $model;

    /**
     * LydoxuatkhoRepository constructor.
     *
     * @param LydoxuatkhoModel $model
     */
    public function __construct(LydoxuatkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find all lydoxuatkho
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a lydoxuatkho by it's ID
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
     * Paginated list of lydoxuatkho
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
            ->orderBy('lydoxuatkho_id', 'desc')
            ->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new a lydoxuatkho
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
     * Delete a lydoxuatkho by it's ID
     *
     * @param LydoxuatkhoModel $lydoxuatkho
     *
     * @return bool|null
     */
    public function delete(LydoxuatkhoModel $lydoxuatkho)
    {
        return $lydoxuatkho->delete();
    }

    /**
     * Update info of a lydoxuatkho
     *
     * @param LydoxuatkhoModel $lydoxuatkho
     *
     * @return bool
     */
    public function update(LydoxuatkhoModel $lydoxuatkho)
    {
        return $lydoxuatkho->save();
    }
}