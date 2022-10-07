<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::pluck('id', 'id')->all();

        //create the super admin role
        $admin = Role::create(['name' => 'Admin']);
        $admin->syncPermissions($permissions);

        $user = User::create([
            'username' => 'upgrade user',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'employee' => '147',
            'posted_by' => '1'
        ]);

        $user->assignRole([$admin->id]);


        //create the manager role
        $admin = Role::create(['name' => 'Manager']);
        $admin->syncPermissions($permissions);

        $user = User::create([
            'username' => 'manager',
            'email' => 'manager@admin.com',
            'password' => bcrypt('admin1234'),
            'employee' => '148',
            'posted_by' => '1'
        ]);

        $user->assignRole([$admin->id]);


        //create the employee role
        $admin = Role::create(['name' => 'Employee']);
        //assign permissions to the employee
        $admin->syncPermissions($permissions);
        //create the user
        $user = User::create([
            'username' => 'employee',
            'email' => 'employee@admin.com',
            'password' => bcrypt('admin1234'),
            'employee' => '149',
            'posted_by' => '1'
        ]);

        $user->assignRole([$admin->id]);
    }
}
