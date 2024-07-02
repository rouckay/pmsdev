<?php

use App\Models\companies;
use App\Models\departments;
use App\Models\file_sharing;
use App\Models\Group;
use App\Models\group_members;
use App\Models\Message;
use App\Models\resources;
use App\Models\task_assignments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\projects;
use Illuminate\Support\Facades\Validator;
use App\Models\tasks;
use Illuminate\Support\Facades\Log;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// list all user in system 
Route::group(
    ['middleware' => ['role:admin']],
    function () {
        Route::get('/users', function () {
            return User::query()->get();
        });
    }
);
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
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // return redirect()->intended('/');
        if (Auth::check()) {
            return "You are logged in Thank you";
        } else {
            return "You are not logged in";
        }
        // return "<h1>You are welcome dear</h1>";
    }

    return "<h1>Incorrect Email or Password!</h1>";
});
// logtout System
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('/');
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

// List of All Departments
Route::get('/departments', function () {
    return departments::query()->get();
});
// Single Department View
Route::get('/department/{id}', function ($id) {
    $department = departments::query()->find($id);
    if (!$department) {
        return response()->json(['message' => 'Department not found'], 404);
    }
    return $department;
});
// Add Departments
Route::post('/add_department', function (Request $request) {
    $department = departments::create([
        'name' => $request->name,
        'company_id' => $request->company_id,
    ]);
    return $department;
});
// Update Departments
Route::put('/department/update/{id}', function (Request $request, $id) {
    $department = departments::find($id);

    if (!$department) {
        return response()->json(['message' => 'Department not found'], 404);
    }
    $department->update($request->all());
    return $department;
});

Route::delete('/department/delete/{id}', function ($id) {
    $department = departments::find($id);

    if (!$department) {
        return response()->json(['message' => 'Department not found'], 404);
    }
    $department->delete();
    return response()->json(['message' => 'Department deleted successfully']);
});
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
Route::get('/files', function () {
    return file_sharing::query()->get();
});
// Single File View
Route::get('/file/{id}', function ($id) {
    $file = file_sharing::find($id);

    if (!$file) {
        return response()->json(['message' => 'File not found'], 404);
    }
    return $file;
});
Route::post('/add_file', function (Request $request) {
    try {
        $file = file_sharing::create([
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
});
// update file
Route::put('/file/update/{id}', function (Request $request, $id) {
    $file = file_sharing::find($id);

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
});
// Delete file
Route::delete('/file/delete/{id}', function ($id) {
    $file = file_sharing::find($id);
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
});













// All Groups not working
Route::get('/groups', function () {
    try {
        return Group::query()->get();
    } catch (\Exception $e) {
        Log::error('Error retrieving groups: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// add Groups not working 
Route::post('/add_group', function (Request $request) {
    // $request->validate([
    //     'project_id' => 'required|exists:projects,id',
    //     'name' => 'required|string|max:255',
    //     'description' => 'required|string',
    //     'created_by' => 'required|exists:created_by,id',
    // ]);

    try {
        $group = Group::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => $request->created_by
        ]);
        return response()->json($group);
    } catch (\Exception $e) {
        Log::error('Error creating group: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// Update Group
Route::put('/group/update/{id}', function (Request $request, $id) {
    $group = Group::find($id);

    if (!$group) {
        return response()->json(['message' => 'Group not found'], 404);
    }

    // $request->validate([
    //     'project_id' => 'nullable|exists:projects,id',
    //     'name' => 'nullable|string|max:255',
    //     'description' => 'nullable|string',
    // ]);

    try {
        $group->update($request->all());
        return response()->json($group, 200);
    } catch (\Exception $e) {
        Log::error('Error updating group: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// Delete Group
Route::delete('/group/delete/{id}', function ($id) {
    $group = Group::find($id);

    if (!$group) {
        return response()->json(['message' => 'Group not found'], 404);
    }

    try {
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully'], 200);
    } catch (\Exception $e) {
        Log::error('Error deleting group: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});

// Group Members API Requests
// add group members
Route::post('/add_group_member', function (Request $request) {
    try {
        $group_member = group_members::create([
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json(['message' => 'Group Member is created successfully!']);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error creating group member: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// get all group members
Route::get('/group_members', function () {
    return group_members::query()->get();
});














// Message API Requests
// add message
Route::post('/add_message', function (Request $request) {
    try {
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'group_id' => $request->group_id,
            'content' => $request->content,
        ]);
        return response()->json(['message' => 'Message is created successfully!']);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error creating message: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});
// get all message
Route::get('/messages', function () {
    return Message::query()->get();
});



















































// Resources API Request
// Add resources
Route::post('/add_resource', function (Request $request) {
    $resources = resources::create([
        'project_id' => $request->project_id,
        'name' => $request->name,
        'resource_type' => $request->resource_type,
        'quantity' => $request->quantity,
    ]);
    return response()->json(['message' => 'Resources is created successfully!']);
});
// get all Resource
Route::get('/resources', function () {
    return resources::query()->get();
});
// get single Resources
Route::get('/resource/{id}', function ($id) {
    $resource = resources::find($id);
    if (!$resource) {
        return response()->json(['message' => 'Could Not found any resources']);
    }
    return $resource;
});
// Edit Resource
Route::put('/resource/update/{id}', function (Request $request, $id) {
    $resource = resources::find($id);

    if (!$resource) {
        return response()->json(['message' => 'Resources not found!']);
    }
    $resource->update($request->all());
    return $resource;
});
// delete Resource
Route::delete('/resource/delete/{id}', function ($id) {
    $resource = resources::find($id);
    if (!$resource) {
        return response()->json(['message' => 'Could not found resource']);
    }
});
// Started Company API Requests
// add Company
Route::post('/add_company', function (Request $request) {
    $company = companies::create([
        'name' => $request->name,
    ]);
    return $company;
});
// List of All Company
Route::get('/companies', function () {
    return companies::query()->get();
});
Route::get('/company/{id}', function ($id) {
    $company = companies::query()->find($id);
    if (!$company) {
        return response()->json(['message' => 'Company not found'], 404);
    }
    return $company;
});
// Update company
Route::put('/company/update/{id}', function (Request $request) {
    $company = companies::find($request->id);
    if (!$company) {
        return response()->json(['message' => 'Company not found'], 404);
    }
    $company->update($request->all());
    return $company;
});

// Delete Company
Route::delete('/company/delete/{id}', function ($id) {
    $company = companies::find($id);
    if (!$company) {
        return response()->json(['message' => 'Company not found'], 404);
    }
    $company->delete();
    return response()->json(['message' => 'Company deleted successfully']);
});



































