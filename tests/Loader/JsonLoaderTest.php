<?php

declare(strict_types=1);

namespace tests\Loader;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use solid\Loader\JsonLoader;

class JsonLoaderTest extends TestCase
{
    public function testDate(): void
    {
        $loader = new JsonLoader();

        $this->assertEquals(
            new DateTimeImmutable('2021-03-12T17:13:10+01:00'),
            $loader->getDate('var/import/users.json')
        );
    }
}
