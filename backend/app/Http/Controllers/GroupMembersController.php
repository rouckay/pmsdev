<?php

namespace App\Http\Controllers;

use App\Models\GroupMembers;
use Illuminate\Http\Request;

class GroupMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return GroupMembers::query()->get();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error group member showing: ' . $e->getMessage());
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
            $group_member = GroupMembers::create([
                'group_id' => $request->group_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json(['message' => 'Group Member is created successfully!', 'Group Members' => $group_member]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating group member: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $groupMember = GroupMembers::find($request->id);
        try {
            return $groupMember;
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error group member showing: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupMembers $groupMembers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $groupMember = GroupMembers::query()->find($request->id);
        if (!$groupMember) {
            return response()->json(['message' => 'Could Not Found any Member Group']);
        }
        try {
            $groupMemberUpdate = GroupMembers::create([
                'group_id' => $request->group_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json(['message' => 'created Successufully', 'Data' => $groupMemberUpdate]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error group member update: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $groupMember = GroupMembers::query()->find($request->id);
            if (!$groupMember) {
                return response()->json(['message' => 'Could Not Found any Member Group']);
            }
            try {
                $groupMember->delete();
                return response()->json(['message' => 'Deleted Successufully']);
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error group member delete: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }
}
