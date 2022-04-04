<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tags = [
            'UI',
            'Front-End',
            'Back-End',
            'WordPress',
            'Framework',
            'Design'
        ];
        foreach ($tags as $tag_name) {
            $tag = new Tag();
            $tag->label = $tag_name;
            $tag->color = $faker->hexColor();
            $tag->save();
        }
    }
}
