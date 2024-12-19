<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptionShort' => 'required|string|max:255',
            'descriptionLong' => 'required|string',
            'pngPath' => 'nullable|string|max:255',
            'pathGitHub' => 'required|string|max:255',
            'pathUrl' => 'nullable|string|max:255',
            'icon' => 'required|file|mimes:jpg,png,svg|max:2048',
        ]);

        $file = $request->file('icon');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('images');
        $file->move($destinationPath, $fileName);

        Project::create([
            'name' => $request->name,
            'descriptionShort' => $request->descriptionShort,
            'descriptionLong' => $request->descriptionLong,
            'pngPath' => 'images/' . $fileName,
            'pathGitHub' => $request->pathGitHub,
            'pathUrl' => $request->pathUrl,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Project $project)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'descriptionShort' => 'required|string|max:255',
            'descriptionLong' => 'required|string',
            'pngPath' => 'nullable|string|max:255',
            'pathGitHub' => 'required|string|max:255',
            'pathUrl' => 'nullable|string|max:255',
            'icon' => 'nullable|file|mimes:jpg,png,svg|max:2048',
        ]);


        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');

            if ($project->pngPath && File::exists(public_path($project->pngPath))) {
                File::delete(public_path($project->pngPath));
            }

            $file->move($destinationPath, $fileName);
            $project->pngPath = 'images/' . $fileName;
        }

        $project->name = $request->name;
        $project->descriptionShort = $request->descriptionShort;
        $project->descriptionLong = $request->descriptionLong;
        $project->pathGitHub = $request->pathGitHub;
        $project->pathUrl = $request->pathUrl;

        $project->save();

        return redirect()->back();
    }
    public function destroy(Project $project){
        $project->delete();
        return redirect()->back();
    }
}
