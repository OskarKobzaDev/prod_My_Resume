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
        $userIp = $request->ip();
        $userAgent = $request->header('User-Agent');

        $messageContent = "You have received a new contact message:\n\n";
        $messageContent .= "Name: " . $validated['name'] . "\n";
        $messageContent .= "Email: " . $validated['email'] . "\n";
        $messageContent .= "IP Address: " . $userIp . "\n";
        $messageContent .= "User Agent: " . $userAgent . "\n\n";
        $messageContent .= "Message:\n" . $validated['message'];

        Mail::raw($messageContent, function ($mail) use ($validated) {
            $mail->to('oskarkobza@gmail.com')
                ->subject('New Contact Message')
                ->replyTo($validated['email'], $validated['name']);
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
