<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            $adminTasksResponse = tasks::query()->get();
            return response()->json([
                'data' => $adminTasksResponse
            ]);
        } else if ($user) {
            $tasks = tasks::query()->where('assigned_to', $user->id)->get();
            return response()->json($tasks);
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

            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'project_id' => 'required|exists:projects,id',
                'description' => 'nullable|string',
                'assigned_to' => 'required|exists:users,id',
                'percentage' => 'nullable|integer|min:0|max:100',
                'due_date' => 'required|date',
                'status' => 'nullable|boolean',
            ]);

            // Create the task
            try {
                $task = tasks::create([
                    'name' => $validated['name'],
                    'project_id' => $validated['project_id'],
                    'description' => $validated['description'],
                    'assigned_to' => $validated['assigned_to'],
                    'percentage' => $validated['percentage'] ?? 0,
                    'due_date' => $validated['due_date'],
                    'status' => $validated['status'] ?? false,
                ]);
                return response()->json($task, 201);
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error creating task: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $task = tasks::query()->find($request->id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        try {
            return $task;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tasks $tasks)
    {
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            // Find the task by ID
            $task = tasks::find($request->id);

            // Check if the task exists
            if (!$task) {
                return response()->json(['message' => 'Task not found'], 404);
            }

            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'project_id' => 'nullable|exists:projects,id',
                'description' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
                'percentage' => 'nullable|integer|min:0|max:100',
                'due_date' => 'nullable|date',
                'status' => 'nullable|boolean',
            ]);

            // Update the task with validated data
            try {
                $task->update($validated);
                return response()->json($task, 200);
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error updating task: ' . $e->getMessage());
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
            $tasks = tasks::find($request->id);
            if (!$tasks) {
                return response()->json(['message' => 'Task not found'], 404);
            }

            try {
                $tasks->delete();
                return response()->json(['message' => 'Task deleted successfully'], 200);
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error deleting task: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }
}
