<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_contact' => 'required|string|max:20',
            'sender_gmail' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Message sent successfully!');
    }

    public function show(Message $message)
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function destroy(Message $message)
{
    try {
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to delete message'], 500);
    }
}
}