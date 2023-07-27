<?php

namespace Hard2Code\Tests\Entities;

use PHPUnit\Framework\TestCase;

class EntityTestBase extends TestCase
{
    /**
     * @param  string  $fileName
     *
     * @return mixed
     */
    protected function includeResourceFile(string $fileName): mixed
    {
        return require __DIR__."/../resources/".$fileName;
    }
}
