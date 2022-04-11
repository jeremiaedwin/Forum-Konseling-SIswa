<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 50; $i++){
            DB::table('likes')->insert([
                'user_id' => $faker->numberBetween(1,8),
                'post_id' => $faker->numberBetween(20,34),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
                
            ]);
        }
    }
}
