<?php

namespace App\Http\Interfaces;

interface ISubjectService
{
    public function getAll(): array;

    public function find(int $id): array;

    public function create(array $data): bool;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function status(int $id, bool $status): bool;
}
