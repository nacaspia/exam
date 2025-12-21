<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ISettingService;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $settingService;
    public function __construct(ISettingService $settingService)
    {
        $this->settingService = $settingService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->settingService->find() ?? null;
        return view('settings.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $settingRequest)
    {
        $data = $settingRequest->all();
        try {
            $this->settingService->create($data);
            return redirect()->route('settings.index')->with('success', 'Yeni ayarlar yaradıldı');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $settingRequest, int $id)
    {
        $data = $settingRequest->all();
        try {
            $this->settingService->update($id,$data);
            return redirect()->route('settings.index')->with('success', 'ayarlar Duzenlendi');
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
        //
    }
}
