<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * ログインを試みます。
     *
     * @param Request $request
     * @return UserResource
     */
    public function login(Request $request): UserResource
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
