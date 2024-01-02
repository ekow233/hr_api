<?php

namespace Database\Seeders;

use App\Models\Approval;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApprovalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Approval::create([
            'name' => 'General Approval',
            'desc' => 'Approval setting for all modules',
            'levels' => 1,
             'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Approval::create([
            'name' => 'Users',
            'desc' => 'Approval setting for users',
            'levels' => 1,
             'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Approval::create([
            'name' => 'Employees',
            'desc' => 'Approval setting for employees',
            'levels' => 1,
             'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Approval::create([
            'name' => 'Announcement',
            'desc' => 'Approval setting for announcement',
            'levels' => 1,
             'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Approval::create([
            'name' => 'Documents',
            'desc' => 'Approval setting for documents',
            'levels' => 1,
             'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Approval::create([
            'name' => 'Company Structures',
            'desc' => 'Approval setting for company sturctures',
            'levels' => 1,
            'self_approval' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

         
    }
}
