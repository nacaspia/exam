<?php

namespace Database\Seeders;

use App\Models\CmsUser;
use App\Models\CmsUserRole;
use App\Models\Permission;
use App\Models\PermissionLabel;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CmsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate(
            ['name' => 'Super Admin'],
        );
        $user = CmsUser::updateOrCreate(
            ['username' => 'super_admin'],    // axtarılacaq dəyər
            [
                'image' => null,
                'name' => 'Super',
                'surname' => 'Admin',
                'phone' => '+994552956727',
                'email' => 'info@nacaspia.com',
                'pin' => '766M0QL',
                'birthday' => '2001-06-01',
                'password' => Hash::make('admin123!!!'),
                'status' => 1,
                'last_login_at' => null,
                'logout_login_at' => null,
            ]
        );

        CmsUserRole::updateOrCreate([
            'cms_user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        $labels = [
            'login' => [
                'login-page'
            ],
            'home' => [
                'home-page'
            ],
            'role' => [
                'role-index',
                'role-create',
                'role-edit',
                'role-delete',
            ],
            'cms-user' => [
                'cms-user-index',
                'cms-user-create',
                'cms-user-edit',
                'cms-user-delete',
            ],
        ];

        foreach ($labels as $labelName => $permissions) {

            // 1. Label yaradılır / tapılır
            $permissionLabel = PermissionLabel::updateOrCreate(
                ['name' => $labelName],
                []
            );

            // 2. Label altına permission-lar yazılır
            foreach ($permissions as $perm) {
                Permission::updateOrCreate(
                    [
                        'permission_label_id' => $permissionLabel->id,
                        'name' => $perm
                    ],
                    []
                );
            }
        }
    }
}
