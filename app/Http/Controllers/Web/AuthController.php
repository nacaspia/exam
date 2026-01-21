<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ForgotPassword;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    public function __construct()
    {

        $this->currentLang = language();
        $this->currentTime = time_now();
    }

    public function login() {

        if (user() != null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        return view('site.auth.login');
    }

    public function loginAccept(LoginRequest $loginRequest)
    {
        try {
            $credentials = $loginRequest->only('email', 'password');

            if (auth('user')->attempt($credentials)) {
                // 🔐 session fixation qoruması
                request()->session()->regenerate();
                // hansı guard login olub
                request()->session()->put('auth_guard', 'user');
                $user = auth('user')->user();

                /*if (!$user->hasVerifiedEmail()) {
                    // Yeni verification link göndər
                    $user->sendEmailVerificationNotification();
                    auth('user')->logout();
                    return response()->json([
                        'success' => false,
                        'errors' => ['Email təsdiqlənməyib. Yeni təsdiq linki emailinizə göndərildi.']
                    ], 403);
                }*/

                return response()->json([
                    'success' => true,
                    'redirect' => route('site.user.account', ['locale' => app()->getLocale()])
                ]);
            }
            return response()->json([
                'success' => false,
                'errors' => ['Email və ya şifrə yanlışdır.']
            ],422);

        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => ['Sistem xəttası!']]);
        }
    }

    public function register() {
        if (user() != null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        return view('site.auth.register');
    }
    public function registerAccept(RegisterRequest $registerRequest)
    {
        DB::beginTransaction();
        try {
            $token = Str::random(64);

            $user = User::create([
                'name' => $registerRequest->name,
                'surname' => $registerRequest->surname,
                'parent' => '-',
                'email' => $registerRequest->email,
                'phone' => $registerRequest->phone,
                'password' => Hash::make($registerRequest->password),
                'status' => false,
                'type' => 'student',
                'email_verification_token' => $token,
            ]);

            $link = url(app()->getLocale() . "/verify-email?token=" . $token);

            Mail::to($user->email)->send(new \App\Mail\VerifyEmailMail($user, $link));

            DB::commit();
            return response()->json([
                'success'  => true,
                'messages' => __('site.register_success')
                //'redirect' => route('site.user.account', ['locale' => app()->getLocale()])
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => [__('site.register_errorr')]]);
        }

    }

    public function verifyEmail(Request $request)
    {
        $user = User::where('email_verification_token', $request->token)->first();

        if (!$user) {
            return redirect()->route('site.auth.login')->withErrors('Token yanlışdır');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'status' => true
        ]);

        if ($user) {
            auth('user')->login($user);
            // 🔐 session fixation qoruması
            request()->session()->regenerate();

            // hansı guard login olub
            request()->session()->put('auth_guard', 'user');
            return redirect()->route('site.user.account', ['locale' => app()->getLocale()])
                ->with('success', 'Email təsdiqləndi');
        }
        return redirect()->route('site.auth.login', ['locale' => app()->getLocale()])
            ->with('success', 'Email təsdiqlənmədi');
    }


    public function forgotPassword() {
        if (user() != null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        return view('site.auth.forgot-password');
    }

    public function forgotPasswordAccept(ForgotPassword $request)
    {
       /* DB::beginTransaction();

        try {*/
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Bu email tapılmadı']
                ]);
            }

            $token = Str::random(64);

            $user->update([
                'password_reset_token' => $token,
                'password_reset_expires_at' => now()->addMinutes(30),
            ]);

            $link = url(app()->getLocale() . '/reset-password?token=' . $token);

            Mail::to($user->email)->send(
                new \App\Mail\ResetPasswordMail($user->name, $link)
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'messages' => ['Şifrə yeniləmə linki emailə göndərildi']
            ]);

        /*} catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'errors' => ['Xəta baş verdi']
            ]);
        }*/
    }


    public function showResetForm(Request $request)
    {
        return view('site.auth.reset-password', [
            'token' => $request->token
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('password_reset_token', $request->token)
            ->where('password_reset_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors('Link etibarsız və ya vaxtı bitib');
        }

        $user->update([
            'password' => Hash::make($request->password),
            'password_reset_token' => null,
            'password_reset_expires_at' => null,
        ]);

        return redirect()->route('site.auth.login', app()->getLocale())
            ->with('success', 'Şifrə uğurla dəyişdirildi');
    }


    public function logout() {
        if (user() == null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        auth('user')->logout();
        return redirect(route('site.auth.login', ['locale' => app()->getLocale()]));
    }


}
