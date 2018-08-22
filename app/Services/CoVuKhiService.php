<?php


namespace App\Services;


use App\Repositories\CoVuKhiRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CoVuKhiService
{
    /**
     * CoVuKhi have status activate
     */
    const ACTIVATE = 1;

    /**
     * CoVuKhi was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var CoVuKhiRepository
     */
    private $coVuKhiRepository;

    /**
     * CoVuKhiService constructor.
     *
     * @param CoVuKhiRepository $coVuKhiRepository
     */
    public function __construct(CoVuKhiRepository $coVuKhiRepository)
    {
        $this->coVuKhiRepository = $coVuKhiRepository;
    }

    /**
     * Do save a weapon size
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->coVuKhiRepository->create($postData);
    }

    /**
     * Delete a covukhi by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $weaponSize = $this->getById($id);

        return $this->coVuKhiRepository->delete($weaponSize);
    }

    /**
     * Update a covukhi by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $weaponSize = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $weaponSize->$key = $value;
        }

        return $this->coVuKhiRepository->update($weaponSize);
    }

    /**
     * Get a covukhi by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $weaponSize = $this->coVuKhiRepository->findById($id);

        if ($weaponSize === null) {
            throw new InternalErrorException("Weapon size not found with id: {$id}");
        }

        return $weaponSize;
    }

    /**
     * Handle data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['covukhi_active'] === 'on') {
            $postData['covukhi_active'] = self::ACTIVATE;
        } else {
            $postData['covukhi_active'] = self::NON_ACTIVATE;
        }
    }
}