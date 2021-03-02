<?php

declare(strict_types=1);

namespace tests;

use PDO;
use PHPUnit\Framework\TestCase;
use solid\Mailing;
use solid\Repository\UserRepository;

class MailingTest extends TestCase
{
    public function testMailing(): void
    {
        $mailing = new Mailing(
            new UserRepository(new PDO(
                'mysql:host=localhost;port=3306;dbname=solid',
                'solid',
                'local'
            ))
        );

        $result = $mailing->sendForActives();

        $this->assertTrue($result);
    }
}
