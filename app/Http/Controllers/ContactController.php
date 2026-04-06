<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Comment;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan terkirim! Terima kasih 🌊');
    }

    public function comment(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'message' => 'required|string|max:500',
            'avatar'  => 'nullable|image|max:5120',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Comment::create([
            'name'       => $request->name,
            'message'    => $request->message,
            'avatar_url' => $avatarPath,
        ]);

        return back()->with('comment_success', 'Komentar ditambahkan!');
    }
}
