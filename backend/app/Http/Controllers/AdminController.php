<?php

namespace App\Http\Controllers;

use App\Models\projects;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminAction(Request $request)
    {
        // Handle admin request
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $project = projects::create([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'department_id' => $request->department_id,
            ]);

            return response()->json(['message' => 'Admin action', 'project' => $project]);
        } else {
            return response()->json(['message' => 'Sorry Unauthorized!']);
        }

    }
}
