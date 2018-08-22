<?php


namespace App\Services;


use App\Repositories\DonViRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class DonViService
{
    /**
     * Unit is activate
     */
    const ACTIVATE = 1;

    /**
     * Unit was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var DonViRepository
     */
    private $donViRepository;

    /**
     * DonViService constructor.
     *
     * @param DonViRepository $donViRepository
     */
    public function __construct(DonViRepository $donViRepository)
    {
        $this->donViRepository = $donViRepository;
    }

    /**
     * Do save an unit
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->donViRepository->create($postData);
    }

    /**
     * Delete an unit
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $unit = $this->getById($id);

        return $this->donViRepository->delete($unit);
    }

    /**
     * Update an unit by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $unit = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $unit->$key = $value;
        }

        return $this->donViRepository->update($unit);
    }

    /**
     * Get an unit by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $unit = $this->donViRepository->findById($id);

        if ($unit === null) {
            throw new InternalErrorException("Unit not found with id: {$id}");
        }

        return $unit;
    }

    /**
     * Get weapon by id
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    public function getWeaponByDonviId($id)
    {
        $unit = $this->donViRepository->findById($id);

        if ($unit === null) {
            throw new InternalErrorException("Unit not found with id: {$id}");
        }

        $thucLucVuKhi = $this->findAllWeaponByDonviId($id);

        return $thucLucVuKhi;
    }

    /**
     * Get number weapon by list ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    public function getWeaponNumberByDonviId($ids)
    {
        $unit = $this->donViRepository->findById($id);

        if ($unit === null) {
            throw new InternalErrorException("Unit not found with id: {$id}");
        }
        $thucLucVuKhiChiTiet = $this->findAllWeaponNumberByWeaponIds($ids);
        return $thucLucVuKhiChiTiet;
    }

    /**
     * Handle post data before save
     * TODO: how does it work?
     *
     * @param array $postData
     */
    public function handleDataBeforeSave(array &$postData)
    {
        $postData['donvi_level'] = 0;
    }
}