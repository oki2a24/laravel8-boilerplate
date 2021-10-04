<?php

namespace Tests\Feature\Controllers\EmailVerificationNotificationController;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class StoreTest extends TestCase
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

        $response = $this
            ->actingAs($user)
            ->postJson('api/email/verification-notification');

        $response->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function メールアドレスの確認メールを再送信すること(): void
    {
        Notification::fake();

        /** @var User */
        $user = User::factory()->unverified()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('api/email/verification-notification');

        $response->assertStatus(202);
        Notification::assertSentTo(
            [$user],
            VerifyEmail::class
        );
    }
}
