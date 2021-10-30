<?php

namespace Tests\Feature\Controllers\PasswordController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function 認証中ユーザーのパスワードを更新できること(): void
    {
        /** @var User */
        $user = User::factory()->create();
        $newPassword = 'newpassword';

        $response = $this
            ->actingAs($user)
            ->putJson('/api/user/password', [
                'current_password' => 'password',
                'password' => $newPassword,
            ]);

        $response->assertOk();
        $user->refresh();
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
