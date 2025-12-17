<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('site.auth.login');
    }
    public function register() {
      /*  if ($this->currentCmsUser) {
            return redirect(route('home'));
        }*/
        return view('site.auth.register');
    }
    public function forgotPassword() {
      /*  if ($this->currentCmsUser) {
            return redirect(route('home'));
        }*/
        return view('site.auth.forgot-password');
    }
}
