<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Payment;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $userId = \user()->id;

        if ($exam->is_paid && $exam->price_type !='free') {
            $paid = Payment::where('user_id', $userId)
                ->where('exam_id', $exam->id)
                ->where('status', 'success')
                ->exists();

            if (!$paid) {
                return view('site.user.exams.pay', compact('exam'));
            }
        }
        if (empty($exam)) { return redirect()->back(); }

        return view('site.user.exams.start', compact('exam'));
    }

    public function examPay(string $local, int $examId)
    {
        app()->setLocale($local);
        $exam = Exam::findOrFail($examId);
        $user = \user();

        // pending payment
        $payment = Payment::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'amount' => $exam->price,
            'provider' => 'payriff',
            'status' => 'pending',
        ]);

        $data = [
            'merchant' => config('services.epoint.merchant_id'),
            'amount' => number_format($exam->price, 2, '.', ''),
            'currency' => 'AZN',
            'order_id' => $payment->id,
            'description' => $exam->title[$local],
            'success_url' => route('site.user.epoint.success', $local),
            'fail_url' => route('site.user.epoint.fail', $local),
            'callback_url' => route('site.user.epoint.callback', $local),
        ];

        $data['signature'] = $this->epointSignature($data);

        return view('site.user.payments.epoint', compact('data'));
    }

    private function epointSignature(array $data): string
    {
        $secret = config('services.epoint.secret');

        $string =
            $data['merchant'] .
            $data['amount'] .
            $data['currency'] .
            $data['order_id'] .
            $secret;

        return hash('sha256', $string);
    }

    public function epointCallback(Request $request, string $locale)
    {
        $payment = Payment::findOrFail($request->order_id);

        // signature yoxla (mütləq!)
        if (!$this->checkEpointSignature($request->all())) {
            abort(403);
        }

        if ($request->status === 'success') {
            $payment->update([
                'status' => 'paid',
                'transaction_id' => $request->transaction_id,
            ]);
        } else {
            $payment->update(['status' => 'failed']);
        }

        return response()->json(['ok' => true]);
    }

    public function epointSuccess(string $locale)
    {
        return redirect()
            ->route('site.user.exams')
            ->with('success', 'Ödəniş uğurla tamamlandı');
    }

    public function epointFail(string $locale)
    {
        return redirect()
            ->route('site.user.exams')
            ->with('error', 'Ödəniş alınmadı');
    }

    public function examStart(string $local, string $exam)
    {
        $userId = \user()->id;
        $exam = Exam::where(['id' => (int)$exam])->first();

        if ($exam->is_paid && $exam->price_type !='free') {
            $paid = Payment::where('user_id', $userId)
                ->where('exam_id', $exam->id)
                ->where('status', 'success')
                ->exists();

            if (!$paid) {
                abort(403, 'Ödəniş edilməyib');
            }
        }
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
