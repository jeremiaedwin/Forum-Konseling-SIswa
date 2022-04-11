<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostviewSeeder extends Seeder
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
            DB::table('post_view')->insert([
                'post_id' => $faker->numberBetween(20,34),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now', $timezone = null)
                
            ]);
        }
    }
}
