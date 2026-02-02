<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        // Payriff success yoxlaması
        if ($request->status !== 'success') {
            return redirect('/payment-failed');
        }

        DB::transaction(function () use ($request) {

            $payment = Payment::create([
                'user_id' => $request->metadata['user_id'],
                'exam_id' => $request->metadata['exam_id'],
                'amount' => $request->amount,
                'provider' => 'payriff',
                'transaction_id' => $request->transaction_id,
                'status' => 'success',
            ]);

            PaymentLog::create([
                'user_id' => $payment->user_id,
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'data' => json_encode($request->all()),
                'status' => true
            ]);
        });

        return redirect()->route('site.user.exams.start', [
            'locale' => app()->getLocale(),
            'exam' => $request->metadata['exam_id']
        ]);
    }
}
