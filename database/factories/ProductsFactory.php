<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Products>
 */
class ProductsFactory extends Factory
{

    protected $model = Products::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name, 
            'price' => $this->faker->numberBetween(100,800),
            'stock' => $this->faker->randomDigitNot(0),
            'description' =>$this->faker->paragraphs(4, true)
        ];
    }
}
