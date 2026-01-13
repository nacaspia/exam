<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IExamService;
use App\Http\Requests\ExamRequest;
use App\Models\Question;
use App\Models\SchoolClass;

class ExamController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $examService;
    public function __construct(IExamService $examService)
    {
        $this->examService = $examService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = $this->examService->getAll();
        return view('exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $questions = Question::orderBy('id','DESC')->get();
        return view('exams.create',compact('schoolClasses','questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $examRequest)
    {
        $data = $examRequest->all();
        try {
            $this->examService->create($data);
            return redirect()->route('exams.index')->with('success', 'Yeni imtahan yaradıldı');
        } catch (\Exception $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $exam = $this->examService->find($id);
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $questions = Question::orderBy('id','DESC')->get();
        return view('exams.show',compact('exam','schoolClasses','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $exam = $this->examService->find($id);
        $selectedQuestionIds = collect($exam['questions'])->pluck('id')->toArray();
        $schoolClasses = SchoolClass::orderBy('id','DESC')->get();
        $questions = Question::orderBy('id','DESC')->get();
        return view('exams.edit',compact('exam','schoolClasses','questions','schoolClasses','selectedQuestionIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $examRequest, int $id)
    {

        $data = $examRequest->all();
        try {
            $this->examService->update($id,$data);
            return redirect()->route('exams.index')->with('success', 'Imtahan düzənləndi');
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
            $this->examService->delete($id);
            return redirect()->route('exams.index')->with('success', 'Imtahan silindi');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
