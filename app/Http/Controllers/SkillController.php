<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request){
        $atributes = $request->validate([
            'name' => 'required',
            'colorHex'=> 'required',
        ]);
        $skill=Skill::create($atributes);
        $skill->save();

        return back()->with('success', 'Data changed successfully!');
    }
    public function destroy(Skill $skill){
        $skill->delete();
    }

    public function update(Request $request, Skill $skill){
        $atributes = $request->validate([
            'name' => 'required',
            'colorHex'=> 'required',
        ]);
        $skill->update($atributes);
        return back()->with('success', 'Data changed successfully!');
    }
}
