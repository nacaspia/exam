<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ISchoolClassService;
use App\Http\Requests\SchoolClassRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $schoolClassService;
    public function __construct(ISchoolClassService $schoolClassService)
    {
        $this->schoolClassService = $schoolClassService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolClasses = $this->schoolClassService->getAll();
        return view('school-classes.index',compact('schoolClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolClassRequest $schoolClassRequest)
    {
        $data = $schoolClassRequest->all();
        try {
            $this->schoolClassService->create($data);
            return redirect()->route('school-classes.index')->with('success', 'Yeni sinif yaradıldı');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schoolClass = $this->schoolClassService->find($id);
        return view('school-classes.show', compact('schoolClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $schoolClass = $this->schoolClassService->find($id);
        return view('school-classes.edit', compact('schoolClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolClassRequest $schoolClassRequest, int $id)
    {
        $data = $schoolClassRequest->all();
        try {
            $this->schoolClassService->update($id,$data);
            return redirect()->route('school-classes.index')->with('success', 'Sinif düzənləndi');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->schoolClassService->delete($id);
            return redirect()->route('school-classes.index')->with('success', 'Sinif ləvğ edildi!');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
