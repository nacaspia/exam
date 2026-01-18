<?php

namespace App\Http\Interfaces;

interface IUserService
{
    public function getAll(): array;

    public function find(int $id): array;

}
