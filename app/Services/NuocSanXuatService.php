<?php


namespace App\Services;


use App\Repositories\NuocSanXuatRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class NuocSanXuatService
{
    /**
     * Country is activate
     */
    const ACTIVATE = 1;

    /**
     * Country was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var NuocSanXuatRepository
     */
    private $nuocSanXuatRepository;

    /**
     * NuocSanXuatService constructor.
     *
     * @param NuocSanXuatRepository $nuocSanXuatRepository
     */
    public function __construct(NuocSanXuatRepository $nuocSanXuatRepository)
    {
        $this->nuocSanXuatRepository = $nuocSanXuatRepository;
    }

    /**
     * Do save info of country
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->nuocSanXuatRepository->create($postData);
    }

    /**
     * Delete a country
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $country = $this->getById($id);

        return $this->nuocSanXuatRepository->delete($country);
    }

    /**
     * Update a country by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $country = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $country->$key = $value;
        }

        return $this->nuocSanXuatRepository->update($country);
    }

    /**
     * Get a country by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $country = $this->nuocSanXuatRepository->findById($id);

        if ($country === null) {
            throw new InternalErrorException("Country not found with id: {$id}");
        }

        return $country;
    }

    /**
     * Handle post data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['nuocsanxuat_active'] === 'on') {
            $postData['nuocsanxuat_active'] = self::ACTIVATE;
        } else {
            $postData['nuocsanxuat_active'] = self::NON_ACTIVATE;
        }
    }
}