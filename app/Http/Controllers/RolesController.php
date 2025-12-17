<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IRoleService;
use App\Http\Requests\RolesRequest;
use App\Models\PermissionLabel;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public $currentLang;
    public $currentCmsUser;
    public $currentTime;
    protected $roleService;
    public function __construct(IRoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->currentLang = language();
        $this->currentCmsUser = cms_user();
        $this->currentTime = time_now();
    }

    public function index()
    {
        $roles = $this->roleService->getAll();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionLabels = PermissionLabel::with('permissions')->orderBy('name','ASC')->get();
        return view('roles.create', compact('permissionLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $rolesRequest)
    {
        $data = $rolesRequest->only(['name', 'permissions']);

        try {
            $this->roleService->create($data);
            return redirect()->route('roles.index')->with('success', 'Yeni role yaradıldı');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $role = $this->roleService->find($id);
        $permissionLabels = PermissionLabel::with('permissions')->orderBy('name','ASC')->get();
        $selectedPermissions = array_column($role['permissions'], 'permission_id');
        return view('roles.show',compact('role','permissionLabels', 'selectedPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $role = $this->roleService->find($id);
        $permissionLabels = PermissionLabel::with('permissions')->orderBy('name','ASC')->get();
        $selectedPermissions = array_column($role['permissions'], 'permission_id');
        return view('roles.edit',compact('role','permissionLabels','selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesRequest $rolesRequest, Role $role)
    {
        $data = $rolesRequest->only(['name', 'permissions']);
        try {
            $this->roleService->update($role->id,$data);
            return redirect()->route('roles.index')->with('success', 'Role düzənləndi');
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
            $this->roleService->delete($id);
            return redirect()->route('roles.index')->with('success', 'Role ləvğ edildi!');
        } catch (\Throwable $e) {
            return back()->withErrors( 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
