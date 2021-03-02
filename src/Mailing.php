<?php

declare(strict_types=1);

namespace solid;

use solid\Repository\UserListsInterface;

class Mailing
{
    private UserListsInterface $userlist;

    public function __construct(UserListsInterface $userList)
    {
        $this->userlist = $userList;
    }

    public function sendForActives(): bool
    {
        foreach ($this->userlist->getActives() as $user) {
            // ...
        }

        return true;
    }
}
