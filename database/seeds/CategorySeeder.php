<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML','color' => 'danger'],
            ['label' => 'CSS','color' => 'primary'],
            ['label' => 'JS','color' => 'warning'],
            ['label' => 'PHP','color' => 'secondary'],
            ['label' => 'Vue','color' => 'success'],
            ['label' => 'Laravel','color' => 'danger'],
        ];

        foreach($categories as $category) { 
            $new_post = new Category();
            $new_post->label = $category['label'];
            $new_post->color = $category['color'];
            $new_post->save();
        }
    }
}
