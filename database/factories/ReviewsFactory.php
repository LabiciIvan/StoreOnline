<?php

namespace Database\Factories;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewsFactory extends Factory
{

    protected $model = Reviews::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'review' => $this->faker->paragraphs(4, true)
        ];
    }
}
