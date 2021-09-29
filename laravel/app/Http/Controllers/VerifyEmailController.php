<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  EmailVerificationRequest  $request
     * @return JsonResponse
     */
    public function __invoke(EmailVerificationRequest $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return  new JsonResponse('', Response::HTTP_NO_CONTENT);
        }

        $request->fulfill();

        return new JsonResponse('', Response::HTTP_ACCEPTED);
    }
}
