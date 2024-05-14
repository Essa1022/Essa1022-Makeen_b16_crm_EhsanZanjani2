<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->word(),
            'category_id' => Category::all('id')->random(),
            'brand_id' => Brand::all('id')->random(),
            'price' => round(fake()->numberBetween(10,500),-1),
            'description' => fake()->text(50),
        ];
    }
}
