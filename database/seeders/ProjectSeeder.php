<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //'name' => $this->faker->name(),
        //            'descriptionShort' => $this->faker->text(80),
        //            'pngPath' => $this->faker->imageUrl(),
        //            'descriptionLong' => $this->faker->text(400),
        //            'pathGitHub'=> $this->faker->url(),
        //            'pathUrl'=> $this->faker->url(),
        Project::factory()->create([
            'name'=>'My Resume',
            'descriptionShort'=>'The page you are currently on.',
            'pngPath'=>'/images/resumeapp.png',
            'descriptionLong'=>'The application you are currently using was built as a Single Page Application (SPA), although its simple design makes this less noticeable. The page includes a basic CMS that allows editing site content (user data, as well as the About and Intro sections) and managing CRUD operations for elements such as Projects, Experiences, Education, Skills, and Languages. To develop the application, I used the Laravel and Vue.js frameworks, with a MySQL server serving as the database.',
            'pathGitHub'=>'https://github.com/Oskar/Oskar',
            'pathUrl'=>'https://oskarkobza.pl',
        ]);
    }
}
