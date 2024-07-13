<?php

namespace App\Http\Controllers;

use App\Models\projects;
use Illuminate\Http\Request;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Projects::query()->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
                $project = Projects::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'department_id' => $request->department_id,
                ]);

                return response()->json([
                    'message' => 'Project created successfully',
                    'project' => $project,
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'You are not authorized to create a project');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $Project = Projects::query()->find($request->id);
            if (!$Project) {
                return response()->json(['message' => 'Project not found'], 404);
            }
            return response()->json([
                'Project' => $Project
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, projects $projects)
    {

        $user = $request->user();
        if ($user->hasRole('admin') || $user->hasRole('Manager')) {
            try {
                $Project = Projects::find($request->id);
                if (!$Project) {
                    return response()->json(['message' => 'Project not found'], 404);
                }
                $Project->update($request->all());
                return response()->json($Project);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
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
            try {
                $Project = Projects::find($request->id);
                if (!$Project) {
                    return response()->json(['message' => 'Project not found'], 404);
                }
                $Project->delete();
                return response()->json(['message' => 'Project deleted successfully']);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
