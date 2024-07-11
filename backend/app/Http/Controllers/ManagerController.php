<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // app/Http/Controllers/ModeratorController.php
    public function managerAction(Request $request)
    {
        // Handle moderator request
        $user = $request->user();
        if ($user->role === 'manager')
            return response()->json(['message' => 'Manager action']);
    }
}
