<?php


namespace App\Services;


use App\Repositories\NhomVuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class NhomVuKhiService
{
    /**
     * NhomVuKhi have status activate
     */
    const ACTIVATE = 1;

    /**
     * NhomVuKhi was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var NhomVuKhiRepository
     */
    private $nhomVuKhiRepository;

    /**
     * NhomVuKhiService constructor.
     *
     * @param NhomVuKhiRepository $nhomVuKhiRepository
     */
    public function __construct(NhomVuKhiRepository $nhomVuKhiRepository)
    {
        $this->nhomVuKhiRepository = $nhomVuKhiRepository;
    }

    /**
     * Do save a weapon group
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->nhomVuKhiRepository->create($postData);
    }

    /**
     * Delete a nhomvukhi by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $weaponGroup = $this->getById($id);

        return $this->nhomVuKhiRepository->delete($weaponGroup);
    }

    /**
     * Update a nhomvukhi by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $weaponGroup = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $weaponGroup->$key = $value;
        }

        return $this->nhomVuKhiRepository->update($weaponGroup);
    }

    /**
     * Get a nhomvukhi by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $weaponGroup = $this->nhomVuKhiRepository->findById($id);

        if ($weaponGroup === null) {
            throw new InternalErrorException("Weapon group not found with id: {$id}");
        }

        return $weaponGroup;
    }

    /**
     * Handle post data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['nhomvukhi_active'] === 'on') {
            $postData['nhomvukhi_active'] = self::ACTIVATE;
        } else {
            $postData['nhomvukhi_active'] = self::NON_ACTIVATE;
        }
    }
}