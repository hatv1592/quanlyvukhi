<?php


namespace App\Repositories;


use App\Model\DonviModel;
use Illuminate\Support\Facades\DB;

class DonViRepository
{
    /**
     * @var DonviModel
     */
    private $model;

    /**
     * DonViRepository constructor.
     *
     * @param DonviModel $model
     */
    public function __construct(DonviModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all donvi
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Get all child
     *
     * @return mixed
     */
    public function findAllChild()
    {
        return $this->model->where('donvi_parent', '>', 0)->get();
    }

    /**
     * Find all parent of units
     *
     * @return mixed
     */
    public function findAllParent()
    {
        return $this->model->where('donvi_parent', 0)->get();
    }

    /**
     * return $this->model->where('donvi_parent', 0)->get();
     * }
     *
     * /**
     * Find all units by parentId
     *
     * @param int $parentId
     * @return mixed
     */
    public function findAllByParent($parentId)
    {
        return $this->model->where('donvi_parent', $parentId)->get();
    }

    /**
     * Find an unit by it's ID
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
     * Find All weapon by it's ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findAllWeaponByDonviId($id)
    {
        return DB::table('thuclucvukhi')
            ->leftJoin('vukhi', 'thuclucvukhi.vukhi_id', '=', 'vukhi.vukhi_id')
            ->leftJoin('donvi', 'thuclucvukhi.donvi_id', '=', 'donvi.donvi_id')
            ->leftJoin('nuocsanxuat', 'thuclucvukhi.nuocsanxuat_id', '=', 'nuocsanxuat.nuocsanxuat_id')
            ->leftJoin('donvitinh', 'thuclucvukhi.donvitinh_id', '=', 'donvitinh.donvitinh_id')
            ->where('thuclucvukhi.donvi_id', $id)
            ->orderBy('thuclucvukhi_id', 'desc')
            ->select('*')
            ->paginate(10);
    }

    /**
     * Find All weapon by it's ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findAllWeaponNumberByWeaponIds($ids)
    {
        return DB::table('thuclucvukhi_chitiet')
            ->whereIn('thuclucvukhi_id', $ids)
            ->orderBy('thuclucvukhi_id', 'desc')
            ->select('*')
            ->get();
    }

    /**
     * Paginate list of units
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
        return $this->model->where('donvi_parent', '>', 0)->paginate($numberPerPage, $columns, $pageName, $page);
    }

    /**
     * Create new an unit
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
     * Delete a an unit
     *
     * @param DonviModel $unit
     *
     * @return bool|null
     */
    public function delete(DonviModel $unit)
    {
        return $unit->delete();
    }

    /**
     * Update info of an unit
     *
     * @param DonviModel $unit
     *
     * @return bool
     */
    public function update(DonviModel $unit)
    {
        return $unit->save();
    }
}