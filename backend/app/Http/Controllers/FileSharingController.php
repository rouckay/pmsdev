<?php

namespace App\Http\Controllers;

use App\Models\FileSharing;
use Illuminate\Http\Request;

class FileSharingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Files = FileSharing::query()->get();
        return $Files;
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
            $file = FileSharing::create([
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'document_url' => $request->document_url,
                'message' => $request->message,
            ]);
            return response()->json(['message' => 'File is created successfully!', 'File:' => $file]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating file: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FileSharing $id)
    {
        $file = FileSharing::find($id);

        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }
        return $file;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $file = FileSharing::find($request->id);

        if (!$file) {
            return response()->json(['message' => 'File not found!']);
        }
        try {
            $file->update($request->all());
            return response()->json(['message' => 'File is updated successfully!', 'File:' => $file]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating file: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FileSharing $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $file = FileSharing::find($request->id);
        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }
        try {
            $file->delete();
            return response()->json(['message' => 'File is deleted successfully!', 'file' => $file]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error deleting file: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
