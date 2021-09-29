<?php

namespace Tests\Feature\Controllers\VerifyEmailController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class InvokeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function すでにメール確認済みであること(): void
    {
        /** @var User */
        $user = User::factory()->create();
        $hash = sha1($user->email);

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );
        $response = $this->actingAs($user)->getJson($url);

        $response->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function メール確認に成功すること(): void
    {
        /** @var User */
        $user = User::factory()->unverified()->create();
        $hash = sha1($user->email);

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );
        $response = $this->actingAs($user)->getJson($url);

        $response->assertStatus(202);
    }
}
