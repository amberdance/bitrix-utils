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


}
