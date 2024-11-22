<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::factory()->create([
            'name'=>'Self-employment, Brisk Setup Oskar Kobza',
            'date'=>'07.2022 - 09.2024',
            'place'=>'Kalisz, Poland',
            'description'=>"Worked on large-scale projects in the field of anti-burglary security systems. Communicated with clients to determine technical and organizational details. Managed a small team based on the system's design. Collaborated with documentation and technical support from manufacturers. Took initiative in self-development and expanding technical expertise. Gained hands-on experience with fiber optic splicing.",
            'iconPath' =>'/images/brisk.jpg'
        ]);
        Experience::factory()->create([
            'name'=>'Sports Advisor, Decathlon',
            'date'=>'10.2018 - 01.2022',
            'place'=>'Kalisz, Poland',
            'description'=>'Provided excellent customer service by addressing all client questions and concerns. Planned daily tasks based on their priority and required completion time. Demonstrated politeness, diligence, and punctuality in all responsibilities.',
            'iconPath' =>'/images/decathlon.png'
        ]);
    }
}
