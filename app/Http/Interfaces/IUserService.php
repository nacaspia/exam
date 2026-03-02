<?php

namespace App\Http\Interfaces;

interface IUserService
{
    public function getAll(): array;

    public function find(int $id): array;
    public function exam(int $examId): array;
    public function examResult(int $userId, int $examId): array;

}
