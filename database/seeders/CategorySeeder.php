<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'comic',
            'novel',
            'fantasy',
            'fiction',
            'mystery',
            'horror',
            'romance',
            'western',
            'thriller',
            'sci-fi',
            'history',
            'biography',
            'adventure',
            'poetry',
            'drama',
            'comedy',
            'non-fiction',
        ];

        foreach ($data as $category) {
            Category::insert([
                'name' => $category,
            ]);
        }
    }
}
