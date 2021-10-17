<?php

namespace Tests\Feature\Controllers\AuthenticatedSessionController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function ログアウト成功すること(): void
    {
        // 準備
        /** @var User */
        $user = User::factory()->create();

        // 実行
        $response = $this
            ->actingAs($user)
            ->postJson('/api/logout');

        $response->assertNoContent();
        $this->assertGuest();
    }
}
