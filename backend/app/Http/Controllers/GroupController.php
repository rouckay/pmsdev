<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            try {
                return Group::query()->get();
            } catch (\Exception $e) {
                Log::error('Error retrieving groups: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
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
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            try {
                $group = Group::create([
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'user_id' => $request->user_id
                ]);
                return response()->json(['message' => 'Your Request Was Successful', 'Response' => $group]);
            } catch (\Exception $e) {
                Log::error('Error creating group: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $group = Group::find($request->id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        try {
            return response()->json($group);
        } catch (\Exception $e) {
            Log::error('Error retrieving groups: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            $group = Group::find($request->id);

            if (!$group) {
                return response()->json(['message' => 'Group not found'], 404);
            }

            $request->validate([
                'project_id' => 'nullable|exists:projects,id',
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            try {
                $group->update($request->all());
                return response()->json(['message' => 'saved successfully', 'your request' => $group], 200);
            } catch (\Exception $e) {
                Log::error('Error updating group: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            $group = Group::find($request->id);

            if (!$group) {
                return response()->json(['message' => 'Group not found'], 404);
            }

            try {
                $group->delete();
                return response()->json(['message' => 'Group deleted successfully'], 200);
            } catch (\Exception $e) {
                Log::error('Error deleting group: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }
}
