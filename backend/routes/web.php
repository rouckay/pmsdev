<?php

use Illuminate\Support\Facades\Route;

$user = Auth::user();

// $user = Auth::user();

// if ($user) {
//     // User is authenticated, proceed to access roles
//     foreach ($user->roles as $role) {
//         echo $role->name;
//     }
// } else {
//     // Handle case where user is not authenticated or not found
//     echo "User not authenticated or not found.";
// }


Route::view('/', 'welcome', ['user' => $user]);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
