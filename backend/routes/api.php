<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\companiesController;
use App\Http\Controllers\departmentsController;
use App\Http\Controllers\FileSharingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMembersController;
use App\Http\Controllers\MessageController;
use App\Models\companies;
use App\Models\departments;
use App\Models\file_sharing;
use App\Models\Group;
use App\Models\group_members;
use App\Models\GroupMembers;
use App\Models\Message;
use App\Models\Resource;
use App\Models\task_assignments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\projects;
use Illuminate\Support\Facades\Validator;
use App\Models\tasks;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\{
    RegisterController,
    LoginController
};
use App\Http\Middleware\CheckAdminRole;
use Illuminate\Support\Facades\Auth;

// admin request
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/google', function (Request $request) {
        return "hello";
    });
});

Route::middleware(['admin'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

// list all user in system 
Route::middleware([CheckAdminRole::class])->group(function () {
    Route::get('/users', function () {
        return User::query()->get();
    });
});
// list single user in system
Route::get('/user/{id}', function ($id) {
    $user = User::query()->find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return $user;
})->middleware('auth:sanctum');
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
Route::post('login', [LoginController::class, 'login']);
// Route::post('/login', function (Request $request) {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         // return redirect()->intended('/');
//         if (Auth::check()) {
//             return "You are logged in Thank you";
//         } else {
//             return "You are not logged in";
//         }
//         // return "<h1>You are welcome dear</h1>";
//     }

//     return "<h1>Incorrect Email or Password!</h1>";
// });


// Register System for Users
Route::middleware(['auth', CheckAdminRole::class])->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
});
// Route::post('/register', function (Request $request) {
//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'phone_number' => $request->phone_number,
//         'address' => $request->address,
//         'type' => $request->type,
//         'password' => Hash::make($request->password),
//         'active' => $request->active,
//     ]);


//     return $user;
// });

// logtout System
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('/');
});
//........................................................................
Route::middleware('auth:sanctum')->group(function () {
    // Admin routes
    // Company APIs Routes
    // Route::post('/admin-action', [AdminController::class, 'adminAction']);
    Route::get('/companies', [companiesController::class, 'index']);
    Route::post('/add_company', [companiesController::class, 'store']);
    Route::get('/company/{id}', [companiesController::class, 'show']);
    Route::put('/company/update/{id}', [companiesController::class, 'edit']);
    Route::delete('/company/delete/{id}', [companiesController::class, 'destroy']);

    // Departments APIs Routes
    Route::get('/departments', [departmentsController::class, 'index']);
    Route::post('/add_department', [departmentsController::class, 'store']);
    Route::put('/department/update/{id}', [departmentsController::class, 'update']);
    Route::get('/department/{id}', [departmentsController::class, 'show']);
    Route::delete('/department/delete/{id}', [departmentsController::class, 'destroy']);

    // File Sharing
    Route::get('/files', [FileSharingController::class, 'index']);
    Route::get('/file/{id}', [FileSharingController::class, 'show']);
    Route::post('/add_file', [FileSharingController::class, 'store']);
    Route::put('/file/update/{id}', [FileSharingController::class, 'edit']);
    Route::delete('/file/delete/{id}', [FileSharingController::class, 'destroy']);

    //Group Routes
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups', [GroupController::class, 'index']);
    Route::post('/add_group', [GroupController::class, 'store']);
    Route::put('/group/update/{id}', [GroupController::class, 'update']);
    Route::delete('/group/delete/{id}', [GroupController::class, 'destroy']);

    //Group_member Routes
    Route::get('/group_members', [GroupMembersController::class, 'index']);
    Route::get('/group_member/{id}', [GroupMembersController::class, 'show']);
    Route::post('/add_group_member', [GroupMembersController::class, 'store']);
    Route::put('/group_member/update/{id}', [GroupMembersController::class, 'update']);
    Route::delete('/group_member/delete/{id}', [GroupMembersController::class, 'destroy']);

    // Messages Routes
    Route::post('/add_message', [MessageController::class, 'store']);
    // Moderator routes
    Route::get('/manager-action', 'ModeratorController@moderatorAction');
});

//........................................................................

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
})->middleware(['auth:sanctum']);
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

// List of All Departments

// Single Department View

// Add Departments

// Update Departments

// Add Task
Route::post('/add_task', function (Request $request) {
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
});

// List of All Tasks
Route::get('/tasks', function () {
    return tasks::query()->get();
});

// Update task by ID
Route::put('/task/update/{id}', function (Request $request, $id) {
    // Find the task by ID
    $task = tasks::find($id);

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
});
// Delete task by ID
Route::delete('/task/delete/{id}', function ($id) {
    $tasks = tasks::find($id);
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
});

// Single Task View
Route::get('/task/{id}', function ($id) {
    $task = tasks::query()->find($id);
    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }
    try {
        return $task;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// Tasks Assignment API Requests
// create tasks assignment
Route::post('/add_task_assignment', function (Request $request) {
    try {
        $task_assignment = task_assignments::create([
            'task_id' => $request->task_id,
            'user_id' => $request->user_id,
            'assigned_date' => $request->assigned_date
        ]);
        return response()->json(['message' => 'Task Assignment is created successfully!']);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error creating task assignment: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// get all task assignment
Route::get('/task_assignments', function () {
    return task_assignments::query()->get();
});
// get single task assignment
Route::get('/task_assignment/{id}', function ($id) {
    $task_assignment = task_assignments::find($id);
    if (!$task_assignment) {
        return response()->json(['message' => 'Could Not found any task assignment']);
    }
    return $task_assignment;
});
// update task assignment
Route::put('/task_assignment/update/{id}', function (Request $request, $id) {
    $task_assignment = task_assignments::find($id);

    if (!$task_assignment) {
        return response()->json(['message' => 'Task assignment not found!']);
    }

    $task_assignment->update($request->all());
    return $task_assignment;
});
// delete task assignment
Route::delete('/task_assignment/delete/{id}', function ($id) {
    $task_assignment = task_assignments::find($id);
    if (!$task_assignment) {
        return response()->json(['message' => 'Could not found task assignment']);
    }
    $task_assignment->delete();
    return response()->json(['message' => 'Task assignment is deleted successfully!']);
});
// File Sharing API Routes

// Single File View

// update file
// Delete file













// All Groups not working

// Update Group

// Delete Group

// Group Members API Requests
// add group members

// get all group members














// Message API Requests
// add message

// get all message
Route::get('/messages', function () {
    return Message::query()->get();
});



















































// Resources API Request
// Add resources
Route::post('/add_resource', function (Request $request) {
    $resources = Resource::create([
        'project_id' => $request->project_id,
        'name' => $request->name,
        'resource_type' => $request->resource_type,
        'quantity' => $request->quantity,
    ]);
    return response()->json(['message' => 'Resources is created successfully!']);
});
// get all Resource
Route::get('/resources', function () {
    return Resource::query()->get();
});
// get single Resources
Route::get('/resource/{id}', function ($id) {
    $resource = Resource::find($id);
    if (!$resource) {
        return response()->json(['message' => 'Could Not found any resources']);
    }
    return $resource;
});
// Edit Resource
Route::put('/resource/update/{id}', function (Request $request, $id) {
    $resource = Resource::find($id);

    if (!$resource) {
        return response()->json(['message' => 'Resources not found!']);
    }
    $resource->update($request->all());
    return $resource;
});
// delete Resource
Route::delete('/resource/delete/{id}', function ($id) {
    $resource = Resource::find($id);
    if (!$resource) {
        return response()->json(['message' => 'Could not found resource']);
    }
});
// Started Company API Requests
// add Company
// List of All Company
// Update company
// Delete Company



































