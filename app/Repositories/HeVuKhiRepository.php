<?php


namespace App\Repositories;


use App\Model\HevukhiModel;

class HeVuKhiRepository
{
    /**
     * @var HevukhiModel
     */
    private $model;

    /**
     * HeVuKhiRepository constructor.
     *
     * @param HevukhiModel $model
     */
    public function __construct(HevukhiModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all hevukhi
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a weapon by it's ID
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
     * Paginate list of weapons
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
     * Create new weapon
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
     * Delete a weapon
     *
     * @param HevukhiModel $hevukhi
     *
     * @return bool|null
     */
    public function delete(HevukhiModel $hevukhi)
    {
        return $hevukhi->delete();
    }

    /**
     * Update info of a weapon
     *
     * @param HevukhiModel $hevukhi
     *
     * @return bool
     */
    public function update(HevukhiModel $hevukhi)
    {
       return $hevukhi->save();
    }
}