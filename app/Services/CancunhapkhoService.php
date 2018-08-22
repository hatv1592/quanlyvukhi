<?php


namespace App\Services;


use App\Repositories\CancunhapkhoRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CancunhapkhoService
{
    /**
     * Cancunhapkho have status activate
     */
    const ACTIVATE = 1;

    /**
     * Cancunhapkho was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var CancunhapkhoRepository
     */
    private $cancunhapkhoRepository;

    /**
     * CancunhapkhoService constructor.
     *
     * @param CancunhapkhoRepository $cancunhapkhoRepository
     */
    public function __construct(CancunhapkhoRepository $cancunhapkhoRepository)
    {
        $this->cancunhapkhoRepository = $cancunhapkhoRepository;
    }

    /**
     * Do save a Cancunhapkho
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->cancunhapkhoRepository->create($postData);
    }

    /**
     * Delete a Cancunhapkho by it's ID
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $cancunhapkho = $this->getById($id);

        return $this->cancunhapkhoRepository->delete($cancunhapkho);
    }

    /**
     * Update a Cancunhapkho by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $cancunhapkho = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $cancunhapkho->$key = $value;
        }

        return $this->cancunhapkhoRepository->update($cancunhapkho);
    }

    /**
     * Get a Cancunhapkho by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $cancunhapkho = $this->cancunhapkhoRepository->findById($id);

        if ($cancunhapkho === null) {
            throw new InternalErrorException("Cancunhapkho not found with id: {$id}");
        }

        return $cancunhapkho;
    }

    /**
     * Handle data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['cancunhapkho_active'] === 'on') {
            $postData['cancunhapkho_active'] = self::ACTIVATE;
        } else {
            $postData['cancunhapkho_active'] = self::NON_ACTIVATE;
        }

        $date = \DateTime::createFromFormat('d-m-Y', $postData['cancunhapkho_date']);
        $postData['cancunhapkho_date'] = $date->format('Y-m-d');
    }
}