<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Profile;
use App\Models\Reviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory(2)->create()->each(function($user) {

            $profile = Profile::factory()->make();
            $profile->user_id = $user->id;
            $profile->save();
            
        });

        $products = Products::factory(100)->create();

        $review = Reviews::factory(300)->make()->each(function($review) use ($user, $products) {

            $review->user_id = $user->random()->id;
            $review->products_id = $products->random()->id;
            $review->save();

        });


    }
}
