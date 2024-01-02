<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'view',
            'create',
            'delete',
            'approval',
            'create user',
            'deactivate user',
            'activate user',
            'view users',
            'view employees',
            'create employee',
            'edit employee',
            'suspend employee',
            'terminate employee',
            'approve employee',
            'company-structure/add',
            'company-structure/edit',
            'company-structure/view'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
