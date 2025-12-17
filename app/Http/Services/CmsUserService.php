<?php

namespace App\Http\Services;

use App\Http\Interfaces\ICmsUserService;
use App\Models\CmsUser;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsUserService implements ICmsUserService
{
    use LoggableTrait;
    public function getAll(): array
    {
        $cmsUsers = CmsUser::with('roles')->orderBy('name','ASC')->get()->toArray();
        return $cmsUsers;
    }

    public function find(int $id): array
    {
        return CmsUser::with('roles')->findOrFail($id)->toArray();
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $model = new CmsUser();
            if (isset($data['image']) && $data['image']->isValid()) {
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('cms_users', $imageName, 'public');
                $model->image = $path;
            }
            $model->username = Str::slug(mb_strtolower($data['username']));
            $model->name = $data['name'];
            $model->surname = $data['surname'];
            $model->phone = $data['phone'];
            $model->email = $data['email'];
            $model->pin = $data['pin'];
            $model->birthday = $data['birthday'];
            $model->password = Hash::make($data['password']);
            $model->status = 1;
            $model->save();

            if (!empty($data['roles'])) {
                $model->roles()->attach($data['roles']);
            }

            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'cms_users',
                description: "Yeni cms istifadəçisi yaradıldı: {$model->username}"
            );
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        DB::beginTransaction();
        try {
            $model = CmsUser::findOrFail($id);
            $old = $model->toArray();
            // Image update
            if (isset($data['image']) && $data['image']->isValid()) {

                // Köhnə image varsa, sil
                if ($model->image && Storage::disk('public')->exists($model->image)) {
                    Storage::disk('public')->delete($model->image);
                }

                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('cms_users', $imageName, 'public');
                $model->image = $path;
            }
            // Update
            $model->name = $data['name'];
            $model->surname = $data['surname'];
            $model->phone = $data['phone'];
            $model->email = $data['email'];
//            $model->pin = $data['pin'];
//            $model->birthday = $data['birthday'];
            if (!empty($data['password']))
            {
                $model->password = Hash::make($data['password']);
            }
            $model->status = 1;
            $model->save();

            // Sync permissions if passed
            if (isset($data['roles'])) {
                $model->roles()->sync($data['roles']);
            }

            DB::commit();
            $this->logAction(
                action:'update',
                objId: $model->id,
                objTable: 'cms_users',
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
            $model = CmsUser::findOrFail($id);
            $old = $model->toArray();

            // detach permissions
            $model->roles()->detach();
            // Image varsa sil
            if ($model->image && Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }
            // delete role
            $model->delete();
            DB::commit();
            $this->logAction(
                action: 'delete',
                objId: $id,
                objTable: 'cms_users',
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
