<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 25; $i++){
        DB::table('comments')->insert([
            'user_id' => $faker->numberBetween(3,8),
            'receiver_id' => $faker->numberBetween(3,8),
        	'post_id' => $faker->numberBetween(20,34),
            'status' => $faker->numberBetween(0),
            'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'anonymous' => $faker->numberBetween(0,1),
            'jawaban_terbaik' => $faker->numberBetween(0,1),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
            
        ]);
        }
    }
}
