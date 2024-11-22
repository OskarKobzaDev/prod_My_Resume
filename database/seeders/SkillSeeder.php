<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::factory()->create([
            'name'=>'HTML5',
            'colorHex'=>'#F06529',
        ]);
        Skill::factory()->create([
            'name'=>'CSS3',
            'colorHex'=>'#2965f1',
        ]);
        Skill::factory()->create([
            'name'=>'JS',
            'colorHex'=>'#f7df1e',
        ]);
        Skill::factory()->create([
            'name'=>'PHP 8.0>',
            'colorHex'=>'#787cb5',
        ]);
        Skill::factory()->create([
            'name'=>'SQL 8.0>',
            'colorHex'=>'#f29111',
        ]);
        Skill::factory()->create([
            'name'=>'Laravel',
            'colorHex'=>'#f55247',
        ]);
        Skill::factory()->create([
            'name'=>'Vue.js',
            'colorHex'=>'#42b883',
        ]);
        Skill::factory()->create([
            'name'=>'Git',
            'colorHex'=>'#f1502f',
        ]);
        Skill::factory()->create([
            'name'=>'Docker',
            'colorHex'=>'#0db7ed',
        ]);
    }
}
