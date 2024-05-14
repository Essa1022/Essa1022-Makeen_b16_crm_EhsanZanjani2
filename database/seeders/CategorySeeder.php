<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Phone', 'Headphone', 'Camera'];
        foreach($categories as $category)
        {
            Category::create([
                'title' => $category,
                'category_id' => 0
            ]);
        }

        $categories = ['5G', 'Button Phone', 'Gaming Phone'];
        foreach($categories as $category)
        {
            Category::create([
                'title' => $category,
                'category_id' => 1
            ]);
        }

        $categories = ['ٌٌWireless Headphones', 'Wired Headphones ', 'Airpod'];
        foreach($categories as $category)
        {
            Category::create([
                'title' => $category,
                'category_id' => 2
            ]);
        }

        $categories = ['ٌٌVideo Camera', 'Lens'];
        foreach($categories as $category)
        {
            Category::create([
                'title' => $category,
                'category_id' => 3
            ]);
        }
    }


}
