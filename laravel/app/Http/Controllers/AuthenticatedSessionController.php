<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
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

    /**
     * ログアウトを試みます。
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
