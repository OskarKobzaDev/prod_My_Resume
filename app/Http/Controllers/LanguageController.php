<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|file|mimes:jpg,png,svg|max:2048',
        ]);
        $file = $request->file('icon');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('images');
        $file->move($destinationPath, $fileName);

        Language::create([
            'name' => $request->name,
            'pngPath' => 'images/' . $fileName,
            ]);

        return redirect()->back()->with('success', 'Language added successfully.');
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|file|mimes:jpg,png,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');

            // Usunięcie starego pliku (jeśli istnieje)
            if ($language->pngPath && File::exists(public_path($language->icon))) {
                File::delete(public_path($language->pngPath));
            }

            // Przeniesienie nowego pliku
            $file->move($destinationPath, $fileName);
            $language->pngPath = 'images/' . $fileName;
        }

        $language->name = $request->name;
        $language->save();

        return redirect()->back()->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->back()->with('success', 'Language deleted successfully.');
    }

}
