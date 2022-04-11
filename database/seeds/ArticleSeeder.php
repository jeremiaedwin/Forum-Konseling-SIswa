<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++){
        $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
        $slug = Str::slug($title);
        DB::table('article')->insert([
        	'user_id' => $faker->numberBetween(2),
        	'category_id' => $faker->numberBetween(1,4),
            'status_id' => $faker->numberBetween(1),
            'title' => $title,
            'slug' => $slug,
            'content' => $faker->text,
            'image' => 'wallpaper.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
            
        ]);
        }
    }
}
