<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                return response()->json([
                    'success' => true,
                    'redirect' => route('site.user.account', ['locale' => app()->getLocale()])
                ]);
            }
            return response()->json([
                'success' => false,
                'errors' => ['Email və ya şifrə yanlışdır.']
            ]);

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
            $user = User::create([
                'name' => $registerRequest->name,
                'surname' => $registerRequest->surname,
                'parent' => '-',
                'email' => $registerRequest->email,
                'phone' => $registerRequest->phone,
                'password' => Hash::make($registerRequest->password),
                'status' => true
            ]);

            auth('user')->login($user);
            // 🔐 session fixation qoruması
            request()->session()->regenerate();

            // hansı guard login olub
            request()->session()->put('auth_guard', 'user');
            DB::commit();
            return response()->json([
                'success'  => true,
                'redirect' => route('site.user.account', ['locale' => app()->getLocale()])
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => ['Sistem xəttası!']]);
        }

    }

    public function logout() {
        if (user() == null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        auth('user')->logout();
        return redirect(route('site.auth.login', ['locale' => app()->getLocale()]));
    }
    public function forgotPassword() {
        if (user() != null) {
            return redirect(route('site.user.account', ['locale' => app()->getLocale()]));
        }
        return view('site.auth.forgot-password');
    }
}
