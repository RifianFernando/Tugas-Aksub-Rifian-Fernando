<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class productsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$category_id = category::pluck('id')->toArray();
        return [
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            // 'category_id' => $this->faker->unique()->numberBetween(1, category::count())
        ];
    }
}
