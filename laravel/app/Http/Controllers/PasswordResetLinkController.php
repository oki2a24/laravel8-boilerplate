<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetLink\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * 指定ユーザーにパスワードリセットメールを送信します。
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? new JsonResponse(['message' => trans($status)], 200)
                    : throw ValidationException::withMessages([
                        'email' => [trans($status)],
                    ]);
    }
}
