<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // Assign Role
        $user_role = Role::where(['name' => 'user'])->first();

        if ($user_role) {
            $user->assignRole($user_role);

            if (!Auth::attempt($request->only('email', 'password'))) {
                Helper::sendError('Email Or Password is wrong');
            }
        }

        return new UserResource($user);
    }
}
