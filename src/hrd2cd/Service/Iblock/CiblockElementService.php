<?php

namespace Hard2Code\Service\Iblock;

use CIBlockElement;
use CModule;
use Hard2Code\Exception\RepositoryException;
use Hard2Code\Repository\CrudRepository;
use Throwable;

final class CiblockElementService implements CrudRepository
{

    private static ?CiblockElementService $instance = null;
    private ?CIBlockElement $CIBlockElement;

    private function __construct()
    {
        CModule::IncludeModule("iblock");
        $this->CIBlockElement = new CIBlockElement();
    }

    /**
     * @return CiblockElementService
     */
    public static function getInstance(): CiblockElementService
    {
        if (self::$instance == null) {
            self::$instance = new CiblockElementService();
        }

        return self::$instance;
    }

    /**
     * @inheritDoc
     * @throws RepositoryException
     */
    public function create(array $fields): int
    {
        try {
            $id = $this->CIBlockElement->Add($fields);

            if (!$id) {
                throw new RepositoryException($this->CIBlockElement->LAST_ERROR);
            }

            return $id;
        } catch (Throwable $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     * @throws RepositoryException
     */
    public function update(int $elementId, array $fields): bool
    {
        $result = $this->CIBlockElement->Update($elementId, $fields);

        if (!$result) {
            throw new RepositoryException($result->LAST_ERROR);
        }

        return $result;
    }
}
