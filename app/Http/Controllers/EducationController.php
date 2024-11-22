<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EducationController extends Controller
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

        Education::create([
            'name' => $request->name,
            'date' => $request->date,
            'place' => $request->place,
            'description' => $request->description,
            'iconPath' => 'images/' . $fileName,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Education $education)
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

            if ($education->iconPath && File::exists(public_path($education->iconPath))) {
                File::delete(public_path($education->pngPath));
            }

            $file->move($destinationPath, $fileName);
            $education->iconPath = 'images/' . $fileName;
        }

        $education->name = $request->name;
        $education->date = $request->date;
        $education->place = $request->place;
        $education->description = $request->description;

        $education->save();

        return redirect()->back();
    }
    public function destroy(Education $education){
        $education->delete();
        return redirect()->back();
    }
}
