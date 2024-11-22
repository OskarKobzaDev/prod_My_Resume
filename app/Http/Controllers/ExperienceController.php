<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExperienceController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'description'=> 'required|string',
            'icon' => 'required|file|mimes:jpg,png,svg|max:2048',
        ]);
        $file = $request->file('icon');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('images');
        $file->move($destinationPath, $fileName);

        Experience::create([
            'name' => $request->name,
            'date' => $request->date,
            'place' => $request->place,
            'description' => $request->description,
            'iconPath' => 'images/' . $fileName,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'description'=> 'required|string',
            'icon' => 'nullable|file|mimes:jpg,png,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');

            if ($experience->iconPath && File::exists(public_path($experience->iconPath))) {
                File::delete(public_path($experience->pngPath));
            }

            $file->move($destinationPath, $fileName);
            $experience->iconPath = 'images/' . $fileName;
        }

        $experience->name = $request->name;
        $experience->date = $request->date;
        $experience->place = $request->place;
        $experience->description = $request->description;

        $experience->save();

        return redirect()->back();
    }
    public function destroy(Experience $experience){
        $experience->delete();
        return redirect()->back();
    }
}
