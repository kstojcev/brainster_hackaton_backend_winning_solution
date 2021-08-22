<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $news = new News();
            $news->title = 'title' . ($i + 1);
            $news->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis exercitationem vel molestias quae facilis illo et ipsum nisi eum pariatur nesciunt, deserunt quidem voluptatem, corrupti odit libero? Quam, nesciunt expedita?' . ($i + 1);
            $news->image = 'images/news_images/news' . ($i + 1) . '.png';
            $news->save();
        }
    }
}
