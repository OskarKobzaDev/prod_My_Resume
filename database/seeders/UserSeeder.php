<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Oskar Kobza',
            'email' => 'oskarkobza@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'phone' => '789-175-519',
            'aboutShort'=>"Hi, I'm Oskar Kobza. I'm 25 years old and I recently graduated with a Bachelor's degree in engineering. I enjoy programming in web technologies and I am constantly developing my skills in this field. I would love to start doing what I love professionally.",
            'aboutLong'=>"Hey, I'm Oskar Kobza. I'm 25 and for the past few years, I've been diving deep into programming, constantly learning and growing in the field. I hold a B.Eng. in Technical Computer Science and Telecommunications, which has provided me with a solid foundation in technology and problem-solving. I have a love for animals, and my free time often revolves around strength training and the strategy of chess, which keep me balanced. My toolbox includes PHP, Laravel, Vue, Tailwind, HTML, CSS, SQL, and JavaScript – technologies I use to bring ideas to life and create meaningful solutions. I'm currently looking for a position where I can turn my passion into a profession, and I'm eager to contribute to exciting and impactful projects in the future.",
            'pronouns'=>"he/him",
            'title'=>"B.Eng. in Computer Science and Telecommunications",
            'avatarPath'=>'/images/me.jpg',
            'remember_token' => Str::random(10),
        ]);
    }
}
