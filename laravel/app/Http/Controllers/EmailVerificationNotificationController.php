<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationNotificationController extends Controller
{
    /**
     * メールアドレスの確認メールを新たに送信します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        }

        $request->user()->sendEmailVerificationNotification();

        return new JsonResponse('', Response::HTTP_ACCEPTED);
    }
}
