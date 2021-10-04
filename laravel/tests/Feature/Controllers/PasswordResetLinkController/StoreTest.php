<?php

namespace Tests\Feature\Controllers\PasswordResetLinkController;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
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
    public function 指定ユーザーにパスワードリセットメールを送信できること(): void
    {
        Notification::fake();

        /** @var User */
        $user = User::factory()->create();

        $response = $this
            ->postJson('/api/forgot-password', ['email' => $user->email]);

        $response->assertOk();
        Notification::assertSentTo(
            [$user],
            ResetPasswordNotification::class
        );
    }

    /**
     * @test
     * @return void
     */
    public function 例外が発生すること(): void
    {
        $response = $this
            ->postJson('/api/forgot-password', ['email' => 'dame@example.com']);

        $response->assertStatus(422);
    }
}
