<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;

class departmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            return departments::query()->get();
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
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
        if ($user->hasRole('admin')) {
            $department = departments::create([
                'name' => $request->name,
                'company_id' => $request->company_id,
            ]);
            return $department;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(departments $id, Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $department = departments::find($id);
            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }
            return $department;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(departments $departments, Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $user = $request->user();
        if ($user->hasRole('admin')) {
            $department = departments::find($request->id);

            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }
            $department->update($request->all());
            return $department;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $department = departments::find($request->id);

            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }
            $department->delete();
            return $department;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }
}
