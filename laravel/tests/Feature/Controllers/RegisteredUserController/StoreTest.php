<?php

namespace Tests\Feature\Controllers\RegisteredUserController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function ユーザーを登録できること()
    {
        $data = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/register', $data);

        $user = User::first();
        $response
            ->assertCreated()
            ->assertExactJson([
                'id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        $this->assertAuthenticatedAs($user);
    }
}
