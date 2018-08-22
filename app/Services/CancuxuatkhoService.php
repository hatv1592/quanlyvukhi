<?php


namespace App\Services;


use App\Repositories\CancuxuatkhoRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CancuxuatkhoService
{
    /**
     * Cancuxuatkho have status activate
     */
    const ACTIVATE = 1;

    /**
     * Cancuxuatkho was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var CancuxuatkhoRepository
     */
    private $cancuxuatkhoRepository;

    /**
     * CancuxuatkhoService constructor.
     *
     * @param CancuxuatkhoRepository $cancuxuatkhoRepository
     */
    public function __construct(
        CancuxuatkhoRepository $cancuxuatkhoRepository
    ) {
        $this->cancuxuatkhoRepository = $cancuxuatkhoRepository;
    }

    /**
     * Do save a cancuxuatkho
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->cancuxuatkhoRepository->create($postData);
    }

    /**
     * Delete a cancuxuatkho by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $cancuxuatkho = $this->getById($id);

        return $this->cancuxuatkhoRepository->delete($cancuxuatkho);
    }

    /**
     * Update a cancuxuatkho by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $cancuxuatkho = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $cancuxuatkho->$key = $value;
        }

        return $this->cancuxuatkhoRepository->update($cancuxuatkho);
    }

    /**
     * Get a cancuxuatkho by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $cancuxuatkho = $this->cancuxuatkhoRepository->findById($id);

        if ($cancuxuatkho === null) {
            throw new InternalErrorException("cancuxuatkho not found with id: {$id}");
        }

        return $cancuxuatkho;
    }

    /**
     * Handle data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['cancuxuatkho_active'] === 'on') {
            $postData['cancuxuatkho_active'] = self::ACTIVATE;
        } else {
            $postData['cancuxuatkho_active'] = self::NON_ACTIVATE;
        }

        $date = \DateTime::createFromFormat('d-m-Y', $postData['cancuxuatkho_date']);
        $postData['cancuxuatkho_date'] = $date->format('Y-m-d');
    }
}