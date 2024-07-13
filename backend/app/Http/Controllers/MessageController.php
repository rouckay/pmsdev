<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $message = Message::query()->get();
            return response()->json(['Data' => $message]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $message = Message::create([
                'sender_id' => $request->sender_id,
                'group_id' => $request->group_id,
                'content' => $request->content,
            ]);
            return response()->json(['message' => 'Message is created successfully!', 'Data' => $message]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating message: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $message = Message::find($request->id);
        try {
            return $message;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = Message::find($request->id);
        if (!$message) {
            return response()->json(['error' => 'Message not found!'], 404);
        }
        try {
            $message->update($request->all());
            return response()->json(['message' => 'New Message is updated successfully!']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $message = Message::find($request->id);
        if (!$message) {
            return response()->json(['error' => 'Message not found!'], 404);
        }
        try {
            $message->delete();
            return response()->json(['message' => 'Message is deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
