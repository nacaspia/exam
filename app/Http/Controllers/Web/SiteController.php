<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
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
        $questions = Exam::query()
            ->orderBy('id', 'DESC')
            ->paginate(9)   // 🔥 pagination
            ->withQueryString(); // filtr saxlasın
        return view('site.index', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects, 'questions' => $questions]);
    }

    public function exams(Request $request)
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        $class_id = (int)$request->class_id ?? null;
        $subject_id = (int)$request->subject_id ?? null;
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $questions = Exam::query()
            ->when($request->class_id, function ($q) use ($class_id) {
                $q->where('class_id', $class_id);
            })
            ->when($subject_id, function ($q) use ($subject_id) {
                $q->whereHas('questions', function ($qq) use ($subject_id) {
                    $qq->where('subject_id', $subject_id);
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(9)   // 🔥 pagination
            ->withQueryString(); // filtr saxlasın
        return view('site.exams', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects, 'questions' => $questions]);
    }
    public function examDetails($local = 'az', $slug, $id)
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();

        $question = Question::query()
            ->where('slug->'.language(), $slug)
            ->where('id', $id)
            ->first();
        return view('site.exam-details', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects, 'question' => $question]);
    }

    public function subjects()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')
            ->paginate(9)   // 🔥 pagination
            ->withQueryString(); // filtr saxlasın->get();

        return view('site.subjects', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects]);
    }

    public function classes()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.language(),'ASC')
            ->paginate(9)   // 🔥 pagination
            ->withQueryString(); // filtr saxlasın->get();
        $subjects = Subject::where(['status' => 1])->orderBy('name->'.language(),'ASC')->get();

        return view('site.classes', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime, 'classes' => $classes, 'subjects' => $subjects]);
    }

    public function achievements()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
        return view('site.achievements', ['currentLang' => $this->currentLang, 'currentTime' => $this->currentTime]);
    }

    public function search(Request $request)
    {
        $query = Exam::query()->where('active', 1);

        // 🔍 Text search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title->'.app()->getLocale(), 'like', "%{$search}%")
                    ->orWhere('text->'.app()->getLocale(), 'like', "%{$search}%");
            });
        }

        // 📚 Class filter
        if ($request->filled('class_id')) {
            $query->where('class_id', (int)$request->class_id);
        }

        // 📘 Subject filter
        if ($request->filled('subject_id')) {
            $query->where('subject_id', (int)$request->subject_id);
        }

        $results = $query->latest()->paginate(12)->withQueryString();

        return view('site.search', [
            'questions'     => $results,
            'currentLang' => $this->currentLang,
            'currentTime' => $this->currentTime,
        ]);
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
