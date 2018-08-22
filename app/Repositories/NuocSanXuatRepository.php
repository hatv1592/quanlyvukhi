<?php


namespace App\Repositories;


use App\Model\NuocsanxuatModel;

class NuocSanXuatRepository
{
    /**
     * @var NuocsanxuatModel
     */
    private $model;

    /**
     * NuocSanXuatRepository constructor.
     *
     * @param NuocsanxuatModel $model
     */
    public function __construct(NuocsanxuatModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a country by it's ID
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
     * Find all nuocsanxat
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Paginated list of countries
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
     * Create new country
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
     * Delete a country
     *
     * @param NuocsanxuatModel $nuocsanxuat
     *
     * @return bool|null
     */
    public function delete(NuocsanxuatModel $nuocsanxuat)
    {
        return $nuocsanxuat->delete();
    }

    /**
     * Update info of a country
     *
     * @param NuocsanxuatModel $nuocsanxuat
     *
     * @return bool
     */
    public function update(NuocsanxuatModel $nuocsanxuat)
    {
        return $nuocsanxuat->save();
    }
}