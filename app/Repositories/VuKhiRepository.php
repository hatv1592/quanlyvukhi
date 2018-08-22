<?php


namespace App\Repositories;


use App\Model\VukhiModel;

class VuKhiRepository
{
    /**
     * @var VukhiModel
     */
    private $model;

    /**
     * VuKhiRepository constructor.
     *
     * @param VukhiModel $model
     */
    public function __construct(VukhiModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all weapon
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
     * Paginate list of weapon
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
     * Delete a weapon
     *
     * @param VukhiModel $vukhi
     *
     * @return bool|null
     */
    public function delete(VukhiModel $vukhi)
    {
        return $vukhi->delete();
    }

    /**
     * Update info of a weapon
     *
     * @param VukhiModel $vukhi
     *
     * @return bool
     */
    public function update(VukhiModel $vukhi)
    {
        return $vukhi->save();
    }
}