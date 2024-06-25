<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\projects;
use Illuminate\Support\Facades\Validator;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// list all user in system 
Route::get('/users', function () {
    $user = User::query()->get();
    if (!$user) {
        return response()->json(['message' => 'There is No User in Database!'], 404);
    }
    return $user;

});
// list single user in system
Route::get('/user/{id}', function ($id) {
    $user = User::query()->find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return $user;
});
// update user in system

Route::put('/user/update/{id}', function (Request $request, $id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        // Add other fields and rules as necessary
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user->update($request->all());
    return response()->json($user);
});


// Login System for Users
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // return redirect()->intended('/');
        return "<h1>You are welcome dear</h1>";
    }

    return "<h1>Incorrect Email or Password!</h1>";
});

// Register System for Users
Route::post('/register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'type' => $request->type,
        'password' => Hash::make($request->password),
        'active' => $request->active,
    ]);


    return $user;
});

// Project Registeration 
Route::post('/add_project', function (Request $request) {
    $project = Projects::create([
        'name' => $request->name,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'department_id' => $request->department_id,
    ]);

    return $project;
});
// Single Project View
Route::get('/project/{id}', function ($id) {
    $Project = Projects::query()->find($id);
    if (!$Project) {
        return response()->json(['message' => 'Project not found'], 404);
    }
    return $Project;
});
// Update Project
Route::put('/project/update/{id}', function (Request $request, $id) {
    $Project = Projects::find($id);

    if (!$Project) {
        return response()->json(['message' => 'Project not found'], 404);
    }

    $Project->update($request->all());
    return response()->json($Project);
});
// Delete Project
Route::delete('/project/delete/{id}', function ($id) {
    $Project = Projects::find($id);

    if (!$Project) {
        return response()->json(['message' => 'Project not found'], 404);
    }

    $Project->delete();
    return response()->json(['message' => 'Project deleted successfully']);
});
Route::middleware('api')->group(function () {
    Route::delete('/project/delete/{id}', function ($id) {
        $Project = Projects::find($id);

        if (!$Project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $Project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    });
});

// List of All Projects
Route::get('/projects', function () {
    return Projects::query()->get();
});

