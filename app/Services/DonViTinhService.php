<?php


namespace App\Services;


use App\Repositories\DonViTinhRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class DonViTinhService
{
    /**
     * Calculation unit is activate
     */
    const ACTIVATE = 1;

    /**
     * Calculation unit was disabled
     */
    const NON_ACTIVATE = 0;

    /**
     * @var DonViTinhRepository
     */
    private $donViTinhRepository;

    /**
     * VuKhiService constructor.
     *
     * @param DonViTinhRepository $donViTinhRepository
     */
    public function __construct(DonViTinhRepository $donViTinhRepository)
    {
        $this->donViTinhRepository = $donViTinhRepository;
    }

    /**
     * Do save a calculation unit
     *
     * @param array $postData
     *
     * @return static
     */
    public function doSave(array $postData)
    {
        $this->handleDataBeforeSave($postData);

        return $this->donViTinhRepository->create($postData);
    }

    /**
     * Delete a calculation unit
     *
     * @param int $id
     *
     * @return int
     *
     * @throws InternalErrorException
     */
    public function doDestroy($id)
    {
        $calculationUnit = $this->getById($id);

        return $this->donViTinhRepository->delete($calculationUnit);
    }

    /**
     * Update a calculation unit by it's ID
     *
     * @param $id
     * @param array $postData
     *
     * @return mixed
     */
    public function doUpdate($id, array $postData)
    {
        $calculationUnit = $this->getById($id);

        $this->handleDataBeforeSave($postData);

        foreach ($postData as $key => $value) {
            $calculationUnit->$key = $value;
        }

        return $this->donViTinhRepository->update($calculationUnit);
    }

    /**
     * Get a calculation unit by it's ID
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws InternalErrorException
     */
    private function getById($id)
    {
        $calculationUnit = $this->donViTinhRepository->findById($id);

        if ($calculationUnit === null) {
            throw new InternalErrorException("Calculation unit not found with id: {$id}");
        }

        return $calculationUnit;
    }

    /**
     * Handle post data before save
     *
     * @param array $postData
     */
    private function handleDataBeforeSave(array &$postData)
    {
        if ($postData['donvitinh_active'] === 'on') {
            $postData['donvitinh_active'] = self::ACTIVATE;
        } else {
            $postData['donvitinh_active'] = self::NON_ACTIVATE;
        }
    }
}