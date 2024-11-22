<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::factory()->create([
            'name'=>'Bachelor of Science in Technical Computer Science and Telecommunications',
            'date'=>'10.2020 - 04.2024',
            'place'=>'Kalisz, Poland',
            'description'=>'My technical studies allowed me to delve into various fields of computer science; however, I dedicated most of my attention to programming and networking technologies. As part of my engineering thesis, I designed and developed a web application for managing employee teams.',
            'iconPath'=>'/images/ak.png',
        ]);
        Education::factory()->create([
            'name'=>'IT Technician',
            'date'=>'09.2015 - 06.2019',
            'place'=>'Kalisz, Poland',
            'description'=>'In technical high school, I had the opportunity to gain knowledge and practical experience in building and diagnosing electronic devices. I also learned the fundamentals of networking and programming technologies.',
            'iconPath'=>'/images/zste.jpg',
        ]);
    }
}
