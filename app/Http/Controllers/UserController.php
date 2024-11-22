<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable',
            'title' => 'nullable|string|max:255',
            'pronouns' => 'nullable|string|max:255',
            'aboutShort' => 'nullable|string|max:300',
            'aboutLong' => 'nullable|string',
        ]);

        $user = auth()->user();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->title = $validated['title'];
        $user->pronouns = $validated['pronouns'];
        $user->aboutShort = $validated['aboutShort'];
        $user->aboutLong = $validated['aboutLong'];

        $user->save();
        return back()->with('success', 'Data changed successfully!');
    }
}
