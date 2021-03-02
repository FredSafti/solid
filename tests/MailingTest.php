<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use solid\Mailing;
use solid\Repository\UserRepository;

class MailingTest extends TestCase
{
    public function testMailing(): void
    {
        $mailing = new Mailing(
            new UserRepository(TestingFactory::createDbConnection())
        );

        $result = $mailing->sendForActives();

        $this->assertTrue($result);
    }
}
