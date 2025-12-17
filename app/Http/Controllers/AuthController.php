<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    public function __construct()
    {
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    public function login() {
        if ($this->currentCmsUser) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function auth(LoginRequest $loginRequest) {
        $credentials = $loginRequest->only('username', 'password');
        if (auth('cms')->attempt($credentials)) {
            return redirect(route('home'));
        }
        return redirect()->back()->withErrors(['errors' => __('error.invalid_credentials')]);
    }

    public function logout()
    {
        auth('cms')->logout();
        return redirect(route('login'));
    }
}
