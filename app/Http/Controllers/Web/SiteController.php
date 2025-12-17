<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public $currentLang;
    public $currentTime;
    public function __construct()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
    }

    public function index()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.index', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function exams()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.exams', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function subjects()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.subjects', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function classes()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.classes', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function achievements()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.achievements', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function blogs()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.blogs', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function about()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.about', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }
    public function services()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.services', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }
    public function faqs()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.faqs', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }
    public function termsConditions()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.terms-conditions', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }
    public function privacyPolicy()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.privacy-policy', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function contact()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.contact', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }
}
