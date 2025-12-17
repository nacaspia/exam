<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
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

    public function account() {
        return view('site.user.account');
    }
}
