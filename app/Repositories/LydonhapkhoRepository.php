<?php


namespace App\Repositories;


use App\Model\LydonhapkhoModel;

class LydonhapkhoRepository
{
    /**
     * @var LydonhapkhoModel
     */
    private $model;

    /**
     * LydonhapkhoRepository constructor.
     *
     * @param LydonhapkhoModel $model
     */
    public function __construct(LydonhapkhoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find all Lydonhapkho
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a Lydonhapkho by it's ID
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
     * Paginated list of Lydonhapkho
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
            ->orderBy('lydonhapkho_id', 'desc')
            ->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new a Lydonhapkho
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
     * Delete a Lydonhapkho by it's ID
     *
     * @param LydonhapkhoModel $lydonhapkho
     *
     * @return bool|null
     */
    public function delete(LydonhapkhoModel $lydonhapkho)
    {
        return $lydonhapkho->delete();
    }

    /**
     * Update info of a Lydonhapkho
     *
     * @param LydonhapkhoModel $lydonhapkho
     *
     * @return bool
     */
    public function update(LydonhapkhoModel $lydonhapkho)
    {
        return $lydonhapkho->save();
    }
}