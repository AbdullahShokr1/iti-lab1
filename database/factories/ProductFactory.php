<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        $categories = ['Electronics','Clothing','Books','Home','Toys','Sports','Beauty','Grocery'];
        $category = $this->faker->randomElement($categories);

        return [
            'name' => ucfirst($this->faker->words(rand(2,4), true)),
            'description' => $this->faker->optional(0.2)->paragraphs(rand(1,3), true),
            'price' => $this->faker->randomFloat(2, 10, 999.99),
            'category' => $category,
            'image' => null, 
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(85), 
        ];
    }

    public function inactive()
    {
        return $this->state(fn() => ['is_active' => false]);
    }
}
