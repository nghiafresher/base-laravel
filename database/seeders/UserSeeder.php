<?php

namespace Database\Seeders;

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
        //permissions
        DB::table('permissions')->insert([
            [
                'name' => 'user-list',
                'display_name' => 'Người dùng',
            ],
            [
                'name' => 'user-show',
                'display_name' => 'Chi tiết người dùng',
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Thêm người dùng',
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'Sửa người dùng',
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Xóa người dùng',
            ],
            [
                'name' => 'role-list',
                'display_name' => 'Vai trò',
            ],
            [
                'name' => 'role-show',
                'display_name' => 'Chi tiết vai trò',
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Thêm vai trò',
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Sửa vai trò',
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Xóa vai trò',
            ],
            [
                'name' => 'permission-list',
                'display_name' => 'Quyền',
            ],
            [
                'name' => 'permission-show',
                'display_name' => 'Chi tiết quyền',
            ],
            [
                'name' => 'permission-create',
                'display_name' => 'Thêm quyền',
            ],
            [
                'name' => 'permission-edit',
                'display_name' => 'Sửa quyền',
            ],
            [
                'name' => 'permission-delete',
                'display_name' => 'Xóa quyền',
            ],
        ]);
    }
}
