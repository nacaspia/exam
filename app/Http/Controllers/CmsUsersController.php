<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ICmsUserService;
use App\Http\Requests\CmsRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class CmsUsersController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $cmsUserService;
    public function __construct(ICmsUserService $cmsUserService)
    {
        $this->cmsUserService = $cmsUserService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
        $this->middleware('permission:cms-user-index')->only('index|show');
        $this->middleware('permission:cms-user-create')->only('create|store');
        $this->middleware('permission:cms-user-edit')->only('edit|update');
        $this->middleware('permission:cms-user-delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cmsUsers = $this->cmsUserService->getAll();
        return view('cms-users.index',compact('cmsUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy("name",'ASC')->get();
        return view('cms-users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CmsRequest $cmsRequest)
    {
        $data = $cmsRequest->all();
        try {
            $this->cmsUserService->create($data);
            return redirect()->route('cms-users.index')->with('success', 'Yeni CMS İnzibatçısı yaradıldı');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cmsUser = $this->cmsUserService->find($id);
        $roles = Role::orderBy("name",'ASC')->get();
        $exams = $this->cmsUserService->exams($cmsUser['id']);
        $questions = $this->cmsUserService->questions($cmsUser['id']);
        return view('cms-users.show',compact('cmsUser','roles', 'questions', 'exams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cmsUser = $this->cmsUserService->find($id);
        $roles = Role::orderBy("name",'ASC')->get();
        return view('cms-users.edit',compact('cmsUser','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CmsRequest $cmsRequest, int $id)
    {
        $data = $cmsRequest->all();
        try {

            $this->cmsUserService->update($id,$data);
            return redirect()->route('cms-users.index')->with('success', 'CMS İnzibatçısı düzənləndi');
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
            $this->cmsUserService->delete($id);
            return redirect()->route('cms-users.index')->with('success', 'CMS İnzibatçısı ləvğ edildi!');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
