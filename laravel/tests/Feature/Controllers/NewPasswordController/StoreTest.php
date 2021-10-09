<?php

namespace Tests\Feature\Controllers\NewPasswordController;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function パスワードリセットできること()
    {
        Event::fake();

        /** @var User */
        $user = User::factory()->create();
        /** @var PasswordBroker */
        $passwordBroker = Password::broker();
        $data = [
            'token' => $passwordBroker->createToken($user),
            'email' => $user->email,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->postJson('/api/reset-password', $data);

        $response->assertOk();
        Event::assertDispatched(PasswordReset::class);
    }

    /**
     * @test
     * @return void
     */
    public function パラメーター不正で例外発送すること()
    {
        /** @var User */
        $user = User::factory()->create();
        $data = [
            'token' => 'errortoken',
            'email' => $user->email,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->postJson('/api/reset-password', $data);

        $response->assertStatus(422);
    }
}
