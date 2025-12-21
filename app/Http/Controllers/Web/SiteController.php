<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\SchoolClass;
use App\Models\Subject;
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
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        return view('site.index', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects]);
    }

    public function exams(Request $request)
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        $class_id = (int)$request->class_id ?? null;
        $subject_id = (int)$request->subject_id ?? null;
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $questions = Question::query()
            ->when($request->class_id, function ($q) use ($class_id) {
                $q->where('class_id', $class_id);
            })
            ->when($request->subject_id, function ($q) use ($subject_id) {
                $q->where('subject_id', $subject_id);
            })
            ->orderBy('id', 'DESC')
            ->paginate(9)   // 🔥 pagination
            ->withQueryString(); // filtr saxlasın
        return view('site.exams', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects, 'questions' => $questions]);
    }
    public function examDetails($slug, $id)
    {
        dd($slug, $id);
        $this->currentLang = language();
        $this->currentTime = time_now();
        // riyaziyyat-6 → [riyaziyyat, 6]
        $parts = explode('-', $slug);
        $id = (int) array_pop($parts);
        $slug = implode('-', $parts);
        dd($slug,$id);
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();

        $question = Question::query()
            ->where('slug->'.language(), $slug)
            ->where('id', $id)
            ->first();
        dd($question,$id,$slug);
        return view('site.exam-details', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects, 'question' => $question]);
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
