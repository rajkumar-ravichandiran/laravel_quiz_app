<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RolesTableSeeder::class]);
        $this->call([CreateDefaultUserSeeder::class]);
        $this->call([CategoryTableSeeder::class]);
        $this->call([QuestionsTableSeeder::class]);
    }
}
