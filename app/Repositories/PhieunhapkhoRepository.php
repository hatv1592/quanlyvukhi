<?php


namespace App\Repositories;


use App\Model\Xuatnhap\PhieunhapkhoModel;

class PhieunhapkhoRepository
{
    /**
     * @var PhieunhapkhoModel
     */
    private $model;

    /**
     * PhieunhapkhoRepository constructor.
     *
     * @param PhieunhapkhoModel $model
     */
    public function __construct(PhieunhapkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all phieunhapkho
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a phieunhapkho by it's ID
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
     * Paginate "phieu nhap kho"
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
     * Create new phieunhapkho
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
     * Delete a phieunhapkho
     *
     * @param PhieunhapkhoModel $phieunhapkho
     *
     * @return bool|null
     */
    public function delete(PhieunhapkhoModel $phieunhapkho)
    {
        return $phieunhapkho->delete();
    }

    /**
     * Update info of a phieunhapkho
     *
     * @param PhieunhapkhoModel $phieunhapkho
     *
     * @return bool
     */
    public function update(PhieunhapkhoModel $phieunhapkho)
    {
        return $phieunhapkho->save();
    }

    /**
     * Update multiple data
     *
     * @param PhieunhapkhoModel $phieunhapkho
     * @param array $data
     *
     * @return bool|int
     */
    public function updateWithAttributes(PhieunhapkhoModel $phieunhapkho, $data = [])
    {
        return $phieunhapkho->update($data);
    }

    /**
     * Get phieunhapkho by conditions
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

        $query->orderBy('pnk_id', 'desc');

        if ($count) {
            return count($query->get());
        }

        return $query->paginate($numberPerPage, ['*'], 'page', $page);
    }
}