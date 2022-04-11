<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 15; $i++){
        $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
        $slug = Str::slug($title);
        DB::table('posts')->insert([
        	'user_id' => $faker->numberBetween(3,8),
        	'category_id' => $faker->numberBetween(1,3),
            'status_id' => $faker->numberBetween(1,2),
            'title' => $title,
            'slug' => $slug,
            'content' => $faker->text,
            'anonymous' => $faker->numberBetween(0,1),
            'solved' => $faker->numberBetween(0,1),
            'total_visit' => $faker->numberBetween(1,50),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
            
        ]);
        }
    }
}
