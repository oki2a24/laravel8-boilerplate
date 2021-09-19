<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * ログインを試みます。
     *
     * @param LoginRequest $request
     * @return UserResource
     */
    public function login(LoginRequest $request): UserResource
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return new UserResource(Auth::user());
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
