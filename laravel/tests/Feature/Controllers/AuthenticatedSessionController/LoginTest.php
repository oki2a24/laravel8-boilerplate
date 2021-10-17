<?php

namespace Tests\Feature\Controllers\AuthenticatedSessionController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function ログイン成功すること(): void
    {
        // 準備
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        // 実行
        $response = $this->postJson('/api/login', $data);

        // 検証
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @return void
     */
    public function ログイン失敗すること(): void
    {
        // 準備
        $user = User::factory()->create();
        $data = [
            'email' => '失敗' . $user->email,
            'password' => 'ログイン失敗するパスワード',
        ];

        // 実行
        $response = $this->postJson('/api/login', $data);

        // 検証
        $response
            ->assertStatus(422);
        $this->assertGuest();
    }
}
