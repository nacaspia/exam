<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function home()
    {
        return view('home');
    }


}
