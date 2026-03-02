<?php

namespace App\Http\Services;

use App\Http\Interfaces\IUserService;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\User;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    use LoggableTrait;
    public function getAll(): array
    {
        $users = User::with('examResults')->orderBy('name','ASC')->get()->toArray();
        return $users;
    }

    public function find(int $id): array
    {
        return User::with(['examResults', 'payments'])->findOrFail($id)->toArray();
    }

    public function exam(int $examId): array
    {
        $exam = Exam::with('questions')->findOrFail($examId);

        return $exam->toArray();
    }

    public function examResult(int $userId, int $examId): array
    {
        $result = ExamResult::with(['studentAnswers'])->where('user_id',  $userId)
            ->where('id', (int)$examId)
            ->where('status', 'finished')
            ->firstOrFail();

        return $result->toArray();
    }



}
