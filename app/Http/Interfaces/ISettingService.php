<?php

namespace App\Http\Interfaces;

interface ISettingService
{
    public function find(): array;

    public function create(array $data): bool;

    public function update(int $id, array $data): bool;
}
