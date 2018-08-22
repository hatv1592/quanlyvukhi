<?php


namespace App\Repositories;


use App\Model\NhomvukhiModel;

class NhomVuKhiRepository
{
    /**
     * @var NhomvukhiModel
     */
    private $model;

    /**
     * NhomVuKhiRepository constructor.
     *
     * @param NhomvukhiModel $model
     */
    public function __construct(NhomvukhiModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all nhomvukhi
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a nhomvukhi by it's ID
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
     * Paginate "nhom vu khi"
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
     * Create new weapon group
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
     * Delete a weapon group
     *
     * @param NhomvukhiModel $nhomvukhi
     *
     * @return bool|null
     */
    public function delete(NhomvukhiModel $nhomvukhi)
    {
        return $nhomvukhi->delete();
    }

    /**
     * Update info of a weapon group
     *
     * @param NhomvukhiModel $nhomvukhi
     *
     * @return bool
     */
    public function update(NhomvukhiModel $nhomvukhi)
    {
        return $nhomvukhi->save();
    }
}