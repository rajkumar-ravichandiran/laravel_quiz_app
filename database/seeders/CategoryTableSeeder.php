<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'General Knowledge'],
            ['id' => 2, 'name' => 'Entertainment: Books'],
            ['id' => 3, 'name' => 'Entertainment: Film'],
            ['id' => 4, 'name' => 'Entertainment: Music'],
            ['id' => 5, 'name' => 'Entertainment: Musicals & Theatres'],
            ['id' => 6, 'name' => 'Entertainment: Television'],
            ['id' => 7, 'name' => 'Entertainment: Video Games'],
            ['id' => 8, 'name' => 'Entertainment: Board Games'],
            ['id' => 9, 'name' => 'Science & Nature'],
            ['id' => 10, 'name' => 'Science: Computers'],
            ['id' => 11, 'name' => 'Science: Mathematics'],
            ['id' => 12, 'name' => 'Mythology'],
            ['id' => 13, 'name' => 'Sports'],
            ['id' => 14, 'name' => 'Geography'],
            ['id' => 15, 'name' => 'History'],
            ['id' => 16, 'name' => 'Politics'],
            ['id' => 17, 'name' => 'Art'],
            ['id' => 18, 'name' => 'Celebrities'],
            ['id' => 19, 'name' => 'Animals'],
            ['id' => 20, 'name' => 'Vehicles'],
            ['id' => 21, 'name' => 'Entertainment: Comics'],
            ['id' => 22, 'name' => 'Science: Gadgets'],
            ['id' => 23, 'name' => 'Entertainment: Japanese Anime & Manga'],
            ['id' => 24, 'name' => 'Entertainment: Cartoon & Animations'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

