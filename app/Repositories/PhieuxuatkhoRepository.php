<?php


namespace App\Repositories;


use App\Model\Xuatnhap\PhieuxuatkhoModel;

class PhieuxuatkhoRepository
{
    /**
     * @var PhieuxuatkhoModel
     */
    private $model;

    /**
     * PhieuxuatkhoRepository constructor.
     *
     * @param PhieuxuatkhoModel $model
     */
    public function __construct(PhieuxuatkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all phieuxuatkho
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a phieuxuatkho by it's ID
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
     * Paginate "phieu xuat kho"
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
            ->where('pnk_status', '>=', 0)
            ->orderBy('pnk_id', 'desc')
            ->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new phieuxuatkho
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
     * Delete a phieuxuatkho
     *
     * @param PhieuxuatkhoModel $phieuxuatkho
     *
     * @return bool|null
     */
    public function delete(PhieuxuatkhoModel $phieuxuatkho)
    {
        return $phieuxuatkho->delete();
    }

    /**
     * Update info of a phieuxuatkho
     *
     * @param PhieuxuatkhoModel $phieuxuatkho
     *
     * @return bool
     */
    public function update(PhieuxuatkhoModel $phieuxuatkho)
    {
        return $phieuxuatkho->save();
    }

    /**
     * Get phieuxuatkho by conditions
     *
     * @param array $conditions
     * @param int $numberPerPage
     * @param int $page
     * @param bool $count
     *
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|int
     */
    public function findByConditions($conditions = [], $numberPerPage, $page, $count = false)
    {
        if (empty($conditions)) {
            return [];
        }

        $query = $this->model->query();

        foreach ($conditions['normal'] as $key => $value) {
            if ($value === 0) {
                $query->where($key,  '<>' , $value);
            } else {
                $query->where($key,  '=' , $value);
            }
        }

        if (!empty($conditions['date'])) {
            if (!empty($conditions['date']['from_date'])) {
                $query->where('created_at',  '>=' , $conditions['date']['from_date']);
            }

            if (!empty($conditions['date']['to_date'])) {
                $query->where('created_at',  '<=' , $conditions['date']['to_date']);
            }
        }

        $query->orderBy('pxk_id', 'desc');

        if ($count) {
            return count($query->get());
        }

        return $query->paginate($numberPerPage, ['*'], 'page', $page);
    }
}