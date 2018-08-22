<?php


namespace App\Repositories;


use App\Model\ThuclucvukhiModel;

class ThuclucvukhiRepository
{
    /**
     * @var ThuclucvukhiModel
     */
    private $model;

    /**
     * ThuclucvukhiRepository constructor.
     *
     * @param ThuclucvukhiModel $model
     */
    public function __construct(ThuclucvukhiModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get thuclucvukhi by conditions
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

        foreach ($conditions as $key => $value) {
            if ((int)$value === 0) {
                $query->where($key,  '<>' , $value);
            } else {
                $query->where($key,  '=' , $value);
            }
        }

        $query->orderBy('thuclucvukhi_id', 'desc');

        if ($count) {
            return count($query->get());
        }

        return $query->paginate($numberPerPage, ['*'], 'page', $page);
    }

    /**
     * Find a thuclucvukhi by it's ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }
}