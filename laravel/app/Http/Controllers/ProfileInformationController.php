<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileInformation\UpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileInformationController extends Controller
{
    /**
     * 認証中ユーザーのプロフィールを更新します。
     *
     * @param  UpdateRequest  $request
     * @return UserResource
     */
    public function update(UpdateRequest $request): UserResource
    {
        $user = $request->user();
        $user->fill($request->validated())->save();

        return new UserResource($user);
    }
}
