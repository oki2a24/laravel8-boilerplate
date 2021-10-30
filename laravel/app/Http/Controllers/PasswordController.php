<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * 認証中ユーザーのパスワードを更新します。
     *
     * @param  UpdateRequest  $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $request->user()->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return new JsonResponse('', Response::HTTP_OK);
    }
}
