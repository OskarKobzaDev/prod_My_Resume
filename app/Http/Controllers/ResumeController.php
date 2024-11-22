<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function index(){
        $user = User::findOrFail(1);
        $educations = Education::all();
        $experiences = Experience::all();
        $skills = Skill::all();
        $languages = Language::all();
        $projects = Project::all();
        return Inertia::render('HomePage',[
            'user' => [
                'name' => $user->name,
                'title' => $user->title,
                'pronouns'=>$user->pronouns,
                'email' => $user->email,
                'phone' => $user->phone,
                'aboutShort'=>$user->aboutShort,
                'aboutLong'=>$user->aboutLong,
                'avatarPath'=>$user->avatarPath,
            ],
            'educations' => $educations,
            'experiences' => $experiences,
            'skills' => $skills,
            'languages' => $languages,
            'projects' => $projects,
        ]);
    }
    public function dashboard(){

    }
}
