<?php

namespace App\Http\Interfaces;

interface ICmsUserService
{
    public function getAll(): array;

    public function find(int $id): array;

    public function create(array $data): bool;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
    public function exams(int $userId): array;
    public function questions(int $userId): array;
}
