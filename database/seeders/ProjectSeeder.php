<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i<10; $i++){
            $project = new Project();
            $project->name = $faker-> paragraphs(3, true);
            $project->summary = $faker-> text(5);

            $project->slug = Str::slug($project->name, '-');

            $project->save();

        }
    }
}
