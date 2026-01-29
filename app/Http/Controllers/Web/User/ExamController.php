<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{

    public $currentLang;
    public $currentUser;
    public $currentTime;
    public function __construct()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
    }
    public function examShow(string $local, string $exam)
    {
        $exam = Exam::where(['id' => (int)$exam])->first();
        if (empty($exam)) { return redirect()->back(); }
        // ödəniş lazımdırsa
        if ($exam->is_paid && $exam->price_type !='free') {
            return view('site.user.exams.pay', compact('exam'));
        }

        return view('site.user.exams.start', compact('exam'));
    }

    public function examPay(string $local, int $examId)
    {
        $exam = Exam::findOrFail($examId);
        $userId = auth()->id();

        /*// artıq ödənilib?
        $paid = ExamPayment::where('user_id', $userId)
            ->where('exam_id', $examId)
            ->where('status', 'paid')
            ->exists();*/
        $paid = true;

        if ($paid) {
            return redirect()->route('site.user.exams.start', [
                'locale' => app()->getLocale(),
                'exam' => $examId
            ]);
        }

        DB::transaction(function () use ($exam, $userId) {
            ExamPayment::updateOrCreate(
                [
                    'user_id' => $userId,
                    'exam_id' => $exam->id
                ],
                [
                    'amount' => $exam->price,
                    'provider' => 'manual',
                    'status' => 'paid',
                    'paid_at' => now()
                ]
            );
        });

        return redirect()->route('site.user.exams.start', [
            'locale' => app()->getLocale(),
            'exam' => $exam->id
        ])->with('success', 'Ödəniş uğurla tamamlandı');
    }

    public function examStart(string $local, string $exam)
    {
        $userId = \user()->id;
        $exam = Exam::where(['id' => (int)$exam])->first();
        if (empty($exam)) { return redirect()->back(); }
        // artıq başlamışsa
        $existing = ExamResult::where('user_id', $userId)
            ->where('exam_id', $exam->id)
            ->where('status', 'started')
            ->first();

        if ($existing) {
            return redirect()->route('site.user.exam.solve',['locale' => app()->getLocale(),'exam' =>$exam->id]);
        }

        ExamResult::create([
            'user_id' => $userId,
            'exam_id' => $exam->id,
            'started_at' => now(),
            'status' => 'started',
        ]);

        return redirect()->route('site.user.exam.solve',['locale' => app()->getLocale(),'exam' =>$exam->id]);
    }

    public function examSolve(string $local, string $exam)
    {
        $user = user();
        $exam = Exam::where(['id' => (int)$exam])->first();
        if (empty($exam)) { return redirect()->back(); }
        $result = ExamResult::where('user_id', $user->id)
            ->where('exam_id', (int)$exam->id)
            ->where('status', 'started')
            ->firstOrFail();

        $questions = $exam->questions()->get();

        return view('site.user.exams.solve', compact('exam','questions','result'));
    }

    public function examFinish(string $local, string $examId, Request $request)
    {
        $result = ExamResult::where('user_id', \user()->id)
            ->where('exam_id', (int)$examId)
            ->where('status', 'started')
            ->firstOrFail();
        if (empty($result)) { return redirect()->back(); }
        $score = 0;

        /*foreach ($request->answers ?? [] as $questionId => $optionId) {
            $correct = QuestionOption::where('id',$optionId)
                ->where('is_correct',1)
                ->exists();

            if ($correct) $score++;
        }*/
        foreach ($request->answers ?? [] as $questionId => $answer) {
            $question = Question::with(['answer'])->find($questionId);
            if (!$question) continue;

            $isCorrect = false;
            $optionId = null;
            $answerText = null;

            if ($question->type === 'multiple_choice') {
                $optionId = $answer;
                $isCorrect = QuestionOption::where('id', $optionId)
                    ->where('is_correct', 1)
                    ->exists();
                if ($isCorrect) $score++;
            } else { // short_text və open_text
                $answerText = $answer;
                $isCorrect = strtolower(trim($answerText)) === strtolower(trim($question->answer->correct_answer ?? ''));
                if ($isCorrect) $score++;
            }

            StudentAnswer::create([
                'user_id' => \user()->id,
                'child_id' => null, // əgər valideyn uşağı üçün cavab verirsə
                'exam_result_id' => $result->id,
                'question_id' => $question->id,
                'question_option_id' => $optionId,
                'answer_text' => $answerText,
                'is_correct' => $isCorrect,
                'score' => $isCorrect ? 1 : 0,
                'time_spent' => $result->duration_type === 'timed' ? now()->diffInSeconds($result->started_at) : 0,
                'answer_json' => is_array($answer) ? $answer : null,
            ]);
        }

        $result->update([
            'total_score' => $score,
            'finished_at' => now(),
            'status' => 'finished',
            'time_spent' => now()->diffInSeconds($result->started_at),
        ]);

        return redirect()->route('site.user.exam.result', [
            'locale' => app()->getLocale(),
            'exam' => $examId
        ]);
    }
    public function examResult(string $locale, string $exam)
    {
        $result = ExamResult::with(['studentAnswers'])->where('user_id', \user()->id)
            ->where('exam_id', (int)$exam)
            ->where('status', 'finished')
            ->firstOrFail();
        if (empty($result)) { return redirect()->back(); }
        $exam = Exam::with('questions')->findOrFail($exam);

        return view('site.user.exams.result', compact('exam','result'));
    }

    private function hasStarted(string $local, string $exam): ?ExamResult
    {
        return ExamResult::where('user_id', auth()->id())
            ->where('exam_id', (int)$exam)
            ->whereIn('status', ['started', 'finished'])
            ->first();
    }

}
