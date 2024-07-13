<?php

namespace App\Http\Controllers;

use App\Models\TaskAssignments;
use Illuminate\Http\Request;

class TaskAssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allTask = TaskAssignments::query()->get();
            return response()->json([
                'data' => $allTask
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
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
                $task_assignment = TaskAssignments::create([
                    'task_id' => $request->task_id,
                    'user_id' => $request->user_id,
                    'assigned_date' => $request->assigned_date
                ]);
                return response()->json([
                    'message' => 'Task Assignment is created successfully!',
                    'data' => $task_assignment
                ]);
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error creating task assignment: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            $task_assignment = TaskAssignments::find($request->id);
            if (!$task_assignment) {
                return response()->json(['message' => 'Could Not found any task assignment']);
            }
            return $task_assignment;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskAssignments $taskAssignments)
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
            $task_assignment = TaskAssignments::find($request->id);
            if (!$task_assignment) {
                return response()->json(['message' => 'Could Not found any task assignment']);
            }
            try {

                if (!$task_assignment) {
                    return response()->json(['message' => 'Task assignment not found!']);
                }

                $task_assignment->update($request->all());

                return response()->json([
                    'message' => 'Task Assignment is updated successfully!',
                    'data' => $task_assignment
                ]);
            } catch (\Exception $e) {
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
            $task_assignment = TaskAssignments::find($request->id);
            if (!$task_assignment) {
                return response()->json(['message' => 'Could not found task assignment']);
            }
            $task_assignment->delete();
            return response()->json(['message' => 'Task assignment is deleted successfully!']);
        }
    }
}
