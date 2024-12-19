<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory()->create([
            'name'=>'Polish (Native)',
            'pngPath'=>'/images/polish.png',
        ]);
        Language::factory()->create([
            'name'=>'English (C1)',
            'pngPath'=>'/images/english.png',
        ]);
    }
}
