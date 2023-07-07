<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateDefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@quiz.app',
            'password' => Hash::make('Quiz@PassWord'),
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now()
        ]);

        $adminrole = Role::findByName('admin');
        $admin->assignRole($adminrole);

        //create staff user
        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@quiz.app',
            'password' => Hash::make('Quiz@PassWord'),
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now()
        ]);

        $staffrole = Role::findByName('staff');
        $staff->assignRole($staffrole);

        //create author user
        $author = User::create([
            'name' => 'Author',
            'email' => 'author@quiz.app',
            'password' => Hash::make('Quiz@PassWord'),
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now()
        ]);

        $authorrole = Role::findByName('author');
        $author->assignRole($authorrole);

         //create candidate user
        $candidate = User::create([
            'name' => 'Candidate',
            'email' => 'candidate@quiz.app',
            'password' => Hash::make('Quiz@PassWord'),
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now()
        ]);

        $candidaterole = Role::findByName('candidate');
        $candidate->assignRole($candidaterole);
    }
}

