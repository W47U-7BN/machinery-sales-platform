<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('customer.chat.index', compact('messages'));
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()->route('customer.chat.index')
            ->with('success', 'Message sent.');
    }

    public function messages(): JsonResponse
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['data' => $messages]);
    }
}
