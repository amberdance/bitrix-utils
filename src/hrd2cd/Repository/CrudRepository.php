<?php

namespace Hard2Code\Repository;

interface CrudRepository
{

    /**
     * @param  array  $fields
     *
     * @return int
     */
    public function create(array $fields): int;

    /**
     * @param  int    $elementId
     * @param  array  $fields
     *
     * @return bool
     */
    public function update(int $elementId, array $fields): bool;
}
