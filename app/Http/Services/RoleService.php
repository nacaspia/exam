<?php

namespace App\Http\Services;

use App\Http\Interfaces\IRoleService;
use App\Models\Role;
use App\Traits\LoggableTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService implements IRoleService
{
    use LoggableTrait;

    public function getAll(): array
    {
        $roles = Role::orderBy('name','ASC')->get()->toArray();
        return $roles;
    }

    public function find(int $id): array
    {
        return Role::with('permissions')->findOrFail($id)->toArray();
    }


    /**
     * @throws Exception
     */
    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {
            $model = new Role();
            $model->name = $data['name'];
            $model->save();

            if (!empty($data['permissions'])) {
                $model->permissionSave()->attach($data['permissions']);
            }

            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'roles',
                description: "Yeni səlahiyyət yaradıldı: {$model->name}"
            );
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function update(int $id, array $data): bool
    {
        DB::beginTransaction();
        try {
            $model = Role::findOrFail($id);
            $old = $model->toArray();
            // Update name
            $model->name = $data['name'];
            $model->save();

            // Sync permissions if passed
            if (isset($data['permissions'])) {
                $model->permissionSave()->sync($data['permissions']);
            }

            DB::commit();
            $this->logAction(
                action:'update',
                objId: $model->id,
                objTable: 'roles',
                description: json_encode([
                    'old' => $old,
                    'new' => $model->toArray()
                ])
            );

            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $model = Role::findOrFail($id);
            $old = $model->toArray();

            // detach permissions
            $model->permissionSave()->detach();

            // delete role
            $model->delete();
            DB::commit();

            $this->logAction(
                action: 'delete',
                objId: $id,
                objTable: 'roles',
                description: json_encode([
                    'old' => $old
                ])
            );

            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
