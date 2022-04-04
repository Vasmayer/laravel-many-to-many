<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $category_ids = Category::pluck('id')->toArray();
        
        for ($i=0; $i < 10; $i++) { 
            $new_post = new Post();
            $new_post->category_id = Arr::random($category_ids);
            $new_post->title = $faker->words(3, true);
            $new_post->image = $faker->imageUrl(250,250, 'animals', true);
            $new_post->description = $faker->sentence();
            $new_post->save();
        }
    }
}
