<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ILanguageService;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $languageService;
    public function __construct(ILanguageService $languageService)
    {
        $this->languageService = $languageService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    public function index()
    {
        $languages = $this->languageService->getAll();
        return view('languages.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $languageRequest)
    {
        $data = $languageRequest->only(['name', 'code']);

        try {
            $this->languageService->create($data);
            return redirect()->route('languages.index')->with('success', 'Yeni dil yaradıldı');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $language = $this->languageService->find($id);
        return view('languages.show',compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $language = $this->languageService->find($id);
        return view('language.edit',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $languageRequest, int $id)
    {
        $data = $languageRequest->only(['name', 'code']);
        try {
            $this->languageService->update($id, $data);
            return redirect()->route('languages.index')->with('success', 'Dil düzənləndi');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->languageService->delete($id);
            return redirect()->route('languages.index')->with('success', 'Dil ləvğ edildi!');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
