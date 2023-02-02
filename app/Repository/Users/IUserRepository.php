<?php

namespace App\Repository\Users;

interface IUserRepository
{
    public function findByUsername(string $username) : object;
    public function create(array $data) : bool;
}
