<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Profile;
use App\Models\Replay;
use App\Models\Reviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laravel\Ui\Presets\React;

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

        $user = User::factory(2)->sameEmail()->create()->each(function($user) {

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

        // we make a user to be admin
        $adminProfile = Profile::factory()->make();
        $admin = User::factory()->after()->create();
        $admin->profile()->save($adminProfile);

        $review2 = Reviews::factory(300)->make()->each(function ($review2) use ($admin, $products) {
            
            $review2->user_id = $admin->id ;
            $review2->products_id = $products->random()->id;

            $review2->save();

            $replay = Replay::factory()->make();
            $replay->userName = $admin->name;
            $replay->user_Id = $admin->id;
            $replay->reviews_id = $review2->id;
            $replay->products_id = $products->random()->id;
            $replay->save();
         
        });

    }
}
