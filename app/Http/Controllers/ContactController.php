<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($mail) use ($validated) {
            $mail->to('oskarkobza@gmail.com')
            ->subject('New Contact Message')
                ->from($validated['email'], $validated['name']);
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
