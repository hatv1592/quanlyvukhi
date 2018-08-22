<?php


namespace App\Repositories;


use App\Model\CovukhiModel;

class CoVuKhiRepository
{
    /**
     * @var CovukhiModel
     */
    private $model;

    /**
     * CoVuKhiRepository constructor.
     *
     * @param CovukhiModel $model
     */
    public function __construct(CovukhiModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all covukhi
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a covukhi by it's ID
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
     * Paginate "co vu khi"
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
        return $this->model->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new weapon size
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
     * Delete a weapon size by it's ID
     *
     * @param CovukhiModel $covukhi
     *
     * @return bool|null
     */
    public function delete(CovukhiModel $covukhi)
    {
        return $covukhi->delete();
    }

    /**
     * Update info of a covukhi
     *
     * @param CovukhiModel $covukhi
     *
     * @return bool
     */
    public function update(CovukhiModel $covukhi)
    {
        return $covukhi->save();
    }
}