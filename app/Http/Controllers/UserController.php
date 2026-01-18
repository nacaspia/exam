<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
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
        $users = $this->userService->getAll();
        return view('users.index',compact('users'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
