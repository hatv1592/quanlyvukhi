<?php


namespace App\Services;


use App\Repositories\HeVuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;


class HeVuKhiService
{
    /**
     * HeVuKhi have status activate
     */
    const ACTIVATE = 1;

    /**
     * HeVuKhi was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var HeVuKhiRepository
     */
    private $heVuKhiRepository;

    /**
     * HeVuKhiService constructor.
     *
     * @param HeVuKhiRepository $heVuKhiRepository
     */
    public function __construct(HeVuKhiRepository $heVuKhiRepository)
    {
        $this->heVuKhiRepository = $heVuKhiRepository;
    }

    /**
     * Do save a weapon
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->heVuKhiRepository->create($postData);
    }

    /**
     * Delete a weapon by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $weapon = $this->getById($id);

        return $this->heVuKhiRepository->delete($weapon);
    }

    /**
     * Update a weapon by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $weapon = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $weapon->$key = $value;
        }

        return $this->heVuKhiRepository->update($weapon);
    }

    /**
     * Get a weapon by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $weapon = $this->heVuKhiRepository->findById($id);

        if ($weapon === null) {
            throw new InternalErrorException("Weapon not found with id: {$id}");
        }

        return $weapon;
    }

    /**
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['hevukhi_active'] === 'on') {
            $postData['hevukhi_active'] = self::ACTIVATE;
        } else {
            $postData['hevukhi_active'] = self::NON_ACTIVATE;
        }
    }
}