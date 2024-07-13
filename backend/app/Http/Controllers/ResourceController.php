<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $resources = Resource::query()->get();
            return response()->json([
                'message' => 'Resources is loaded successfully!',
                'data' => $resources
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to list all Resources!',
                'error' => $e->getMessage()
            ]);
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
            $resources = Resource::create([
                'project_id' => $request->project_id,
                'name' => $request->name,
                'resource_type' => $request->resource_type,
                'quantity' => $request->quantity,
            ]);
            return response()->json([
                'message' => 'Resources is created successfully!',
                'data' => $resources
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create Resources!',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        $resource = Resource::find($resource->id);
        if (!$resource) {
            return response()->json([
                'message' => 'Resource not found!',
            ], 404);
        }
        // return $resource;
        try {
            return response()->json([
                'message' => 'Resources is loaded successfully!',
                'data' => $resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load Resources!',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $resource = Resource::find($request->id);
        if (!$resource) {
            return response()->json(['message' => 'Could Not found any resources']);
        }
        try {
            $resource->update($request->all());
            return response()->json([
                'message' => 'Resources is updated successfully!',
                'data' => $resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create Resources!',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $resource = Resource::find($request->id);
        if (!$resource) {
            return response()->json(['message' => 'Could Not found any resources']);
        }
        try {

            return response()->json([
                'message' => 'Resources is updated successfully!',
                'data' => $resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create Resources!',
                'error' => $e->getMessage()
            ]);
        }
    }
}
