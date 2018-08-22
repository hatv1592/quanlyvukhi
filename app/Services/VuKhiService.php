<?php


namespace App\Services;


use App\Repositories\VuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class VuKhiService
{
    /**
     * Weapon is activate
     */
    const ACTIVATE = 1;

    /**
     * Weapon was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var VuKhiRepository
     */
    private $vuKhiRepository;

    /**
     * VuKhiService constructor.
     *
     * @param VuKhiRepository $vuKhiRepository
     */
    public function __construct(VuKhiRepository $vuKhiRepository)
    {
        $this->vuKhiRepository = $vuKhiRepository;
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

        return $this->vuKhiRepository->create($postData);
    }

    /**
     * Delete a weapon
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

        return $this->vuKhiRepository->delete($weapon);
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

        return $this->vuKhiRepository->update($weapon);
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
        $weapon = $this->vuKhiRepository->findById($id);

        if ($weapon === null) {
            throw new InternalErrorException("Weapon not found with id: {$id}");
        }

        return $weapon;
    }

    /**
     * Handle post data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['vukhi_active'] === 'on') {
            $postData['vukhi_active'] = self::ACTIVATE;
        } else {
            $postData['vukhi_active'] = self::NON_ACTIVATE;
        }
    }
}