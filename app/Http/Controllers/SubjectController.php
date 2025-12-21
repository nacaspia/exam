<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ISubjectService;
use App\Http\Requests\SubjectRequest;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $subjectService;
    public function __construct(ISubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = $this->subjectService->getAll();
        return view('subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $subjectRequest)
    {
        $data = $subjectRequest->all();
        try {
            $this->subjectService->create($data);
            return redirect()->route('subjects.index')->with('success', 'Yeni fənn yaradıldı');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subjects = $this->subjectService->find($id);
        return view('subjects.show', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $subjects = $this->subjectService->find($id);
        return view('subjects.edit', compact('subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $subjectRequest, int $id)
    {
        $data = $subjectRequest->all();
        try {
            $this->subjectService->update($id,$data);
            return redirect()->route('subjects.index')->with('success', 'Fənn düzənləndi');
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
            $this->subjectService->delete($id);
            return redirect()->route('subjects.index')->with('success', 'Fənn ləvğ edildi!');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
