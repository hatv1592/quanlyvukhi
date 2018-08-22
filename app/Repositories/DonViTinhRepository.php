<?php


namespace App\Repositories;


use App\Model\DonvitinhModel;

class DonViTinhRepository
{
    /**
     * @var DonvitinhModel
     */
    private $model;

    /**
     * DonViTinhRepository constructor.
     *
     * @param DonvitinhModel $model
     */
    public function __construct(DonvitinhModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find all calculation units
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a calculation unit by it's ID
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
     * Paginate list of calculation unit
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
     * Create new calculation unit
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
     * Delete a calculation unit
     *
     * @param DonvitinhModel $donvitinh
     *
     * @return bool|null
     */
    public function delete(DonvitinhModel $donvitinh)
    {
        return $donvitinh->delete();
    }

    /**
     * Update info of a calculation unit
     *
     * @param DonvitinhModel $donvitinh
     *
     * @return bool
     */
    public function update(DonvitinhModel $donvitinh)
    {
        return $donvitinh->save();
    }
}