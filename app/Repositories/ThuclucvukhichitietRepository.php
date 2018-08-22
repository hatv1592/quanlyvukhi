<?php


namespace App\Repositories;


use App\Model\ThuclucvukhichitietModel;

class ThuclucvukhichitietRepository
{
    /**
     * @var ThuclucvukhichitietModel
     */
    private $model;

    /**
     * ThuclucvukhiRepository constructor.
     *
     * @param ThuclucvukhichitietModel $model
     */
    public function __construct(ThuclucvukhichitietModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get thuclucvukhi by conditions
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function findByConditions(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }
}