<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 16; $i++) {
            $project = new Project();
            $project->title = 'title' . ($i + 1);
            $project->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis exercitationem vel molestias quae facilis illo et ipsum nisi eum pariatur nesciunt, deserunt quidem voluptatem, corrupti odit libero? Quam, nesciunt expedita?' . ($i + 1);
            $project->location = 'location' . ($i + 1);
            $project->date = Carbon::now();
            $project->save();
        }
    }
}
