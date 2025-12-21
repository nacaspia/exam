<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IQuestionService;
use App\Http\Requests\QuestionRequest;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $questionService;
    public function __construct(IQuestionService $questionService)
    {
        $this->questionService = $questionService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->getAll();
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $subjects = Subject::orderBy('id','DESC')->get();
        return view('questions.create',compact('schoolClasses','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $questionRequest)
    {
        $data = $questionRequest->all();
        try {
            $this->questionService->create($data);
            return redirect()->route('questions.index')->with('success', 'Yeni sual yaradıldı');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $question = $this->questionService->find($id);
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $subjects = Subject::orderBy('id','DESC')->get();
        return view('questions.edit',compact('question','schoolClasses','subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $question = $this->questionService->find($id);
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $subjects = Subject::orderBy('id','DESC')->get();
        return view('questions.edit',compact('question','schoolClasses','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $questionRequest, int $id)
    {

        $data = $questionRequest->all();
        try {
            $this->questionService->update($id,$data);
            return redirect()->route('questions.index')->with('success', 'Sual düzənləndi');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->questionService->delete($id);
            return redirect()->route('questions.index')->with('success', 'Sual silindi');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
