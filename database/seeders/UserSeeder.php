<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'is_super_admin' => User::IS_SUPER_ADMIN,
                'phone' => '0123456789',
                'password' => bcrypt(12345678)
            ],
            [
                'name' => 'dev',
                'email' => 'dev@dev.com',
                'is_super_admin' => 0,
                'phone' => '0913134567',
                'password' => bcrypt(12345678)
            ]
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Super Admin',
            ],
            [
                'name' => 'ctv',
                'display_name' => 'Công tác viên',
            ]
        ]);
        //permissions
        DB::table('permissions')->insert([
            [
                'name' => 'user-list',
                'display_name' => 'Người dùng',
                'model_name' => 'User'
            ],
            [
                'name' => 'user-show',
                'display_name' => 'Chi tiết người dùng',
                'model_name' => 'User'
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Thêm người dùng',
                'model_name' => 'User'
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'Sửa người dùng',
                'model_name' => 'User'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Xóa người dùng',
                'model_name' => 'User'
            ],
            [
                'name' => 'role-list',
                'display_name' => 'Vai trò',
                'model_name' => 'Role'
            ],
            [
                'name' => 'role-show',
                'display_name' => 'Chi tiết vai trò',
                'model_name' => 'Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Thêm vai trò',
                'model_name' => 'Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Sửa vai trò',
                'model_name' => 'Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Xóa vai trò',
                'model_name' => 'Role'
            ],
            [
                'name' => 'permission-list',
                'display_name' => 'Quyền',
                'model_name' => 'Permission'
            ],
            [
                'name' => 'permission-show',
                'display_name' => 'Chi tiết quyền',
                'model_name' => 'Permission'
            ],
            [
                'name' => 'permission-create',
                'display_name' => 'Thêm quyền',
                'model_name' => 'Permission'
            ],
            [
                'name' => 'permission-edit',
                'display_name' => 'Sửa quyền',
                'model_name' => 'Permission'
            ],
            [
                'name' => 'permission-delete',
                'display_name' => 'Xóa quyền',
                'model_name' => 'Permission'
            ],
        ]);
    }
}
