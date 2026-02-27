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


    public function examPay(string $locale, int $examId)
    {
        app()->setLocale($locale);

        $exam = Exam::findOrFail($examId);
        $user = auth()->user();

        $payment = Payment::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'amount' => $exam->price,
            'provider' => 'epoint',
            'status' => 'pending',
        ]);

        $json = [
            "public_key" => config('services.epoint.public_key'),
            "amount" => number_format($exam->price, 2, '.', ''),
            "currency" => "AZN",
            "language" => $locale,
            "order_id" => (string)$payment->id,
            "description" => $exam->title[$locale] ?? 'Exam payment',
            "success_redirect_url" => route('site.user.epoint.success', $locale),
            "error_redirect_url" => route('site.user.epoint.fail', $locale),
        ];

        $data = base64_encode(json_encode($json));

        $privateKey = config('services.epoint.private_key');

        $signature = base64_encode(
            sha1($privateKey . $data . $privateKey, true)
        );

        $response = Http::asForm()->post(
            config('services.epoint.url'),
            [
                'data' => $data,
                'signature' => $signature,
            ]
        );

        if (!$response->successful()) {
            echo '1';
            dd($response->body());
        }

        $responseData = $response->json();

        if (!isset($responseData['redirect_url'])) {
            echo '2';
            dd($responseData);
        }

        return redirect($responseData['redirect_url']);
    }

    public function epointCallback(Request $request, string $locale)
    {
        $data = $request->data;
        $signature = $request->signature;

        $privateKey = config('services.epoint.private_key');

        $checkSignature = base64_encode(
            sha1($privateKey . $data . $privateKey, true)
        );

        if ($signature !== $checkSignature) {
            abort(403);
        }

        $decoded = json_decode(base64_decode($data), true);

        $payment = Payment::findOrFail($decoded['order_id']);

        if ($decoded['status'] === 'success') {
            $payment->update([
                'status' => 'paid',
                'transaction_id' => $decoded['transaction_id'] ?? null,
            ]);
        } else {
            $payment->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'ok']);
    }


    public function epointSuccess()
    {
        return redirect()
            ->route('site.user.exams',['locale'=>'az'])
            ->with('success', 'Ödəniş uğurla tamamlandı');
    }

    public function epointFail()
    {
        return redirect()
            ->route('site.user.exams',['locale'=>'az'])
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
