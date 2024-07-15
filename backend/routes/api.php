<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\companiesController;
use App\Http\Controllers\departmentsController;
use App\Http\Controllers\FileSharingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMembersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TaskAssignmentsController;
use App\Http\Controllers\tasksController;
use App\Models\companies;
use App\Models\departments;
use App\Models\file_sharing;
use App\Models\Group;
use App\Models\group_members;
use App\Models\GroupMembers;
use App\Models\Message;
use App\Models\Resource;
use App\Models\task_assignments;
use App\Models\TaskAssignments;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
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
    Route::get('/group/{id}', [GroupController::class, 'show']);
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
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/message/{id}', [MessageController::class, 'show']);
    Route::put('/message/update/{id}', [MessageController::class, 'update']);
    Route::delete('/message/delete/{id}', [MessageController::class, 'destroy']);

    // Projects Routes
    Route::get('/projects', [projectsController::class, 'index']);
    Route::post('/add_project', [projectsController::class, 'store']);
    Route::get('/project/{id}', [projectsController::class, 'show']);
    Route::put('/project/update/{id}', [projectsController::class, 'update']);
    Route::delete('/project/delete/{id}', [projectsController::class, 'destroy']);

    // Task Assignment
    Route::get('/task_assignments', [TaskAssignmentsController::class, 'index']);
    Route::get('/task_assignment/{id}', [TaskAssignmentsController::class, 'show']);
    Route::post('/add_task_assignment', [TaskAssignmentsController::class, 'store']);
    Route::put('/task_assignment/update/{id}', [TaskAssignmentsController::class, 'update']);
    Route::delete('/task_assignment/delete/{id}', [TaskAssignmentsController::class, 'destroy']);

    // Tasks Routes
    Route::post('/add_task', [tasksController::class, 'store']);
    Route::get('/tasks', [tasksController::class, 'index']);
    Route::get('/task/{id}', [tasksController::class, 'show']);
    Route::put('/task/update/{id}', [tasksController::class, 'update']);
    Route::delete('/task/delete/{id}', [tasksController::class, 'destroy']);

    // Resources Routes
    Route::get('/resources', [ResourceController::class, 'index']);
    Route::post('/add_resource', [ResourceController::class, 'store']);
    Route::get('/resource/{id}', [ResourceController::class, 'show']);
    Route::put('/resource/update/{id}', [ResourceController::class, 'update']);
    Route::delete('/resource/delete/{id}', [ResourceController::class, 'destroy']);


    // Moderator routes
    Route::get('/manager-action', 'ModeratorController@moderatorAction');
});

//........................................................................








// Resources API Request

// get single Resources

// Edit Resource

// delete Resource

// Started Company API Requests
// add Company
// List of All Company
// Update company
// Delete Company



































