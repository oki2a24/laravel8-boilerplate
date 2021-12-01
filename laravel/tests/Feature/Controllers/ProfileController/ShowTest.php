<?php

namespace Tests\Feature\Controllers\ProfileController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function 認証中ユーザーのプロフィールを取得できること(): void
    {
        /** @var User */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->getJson('/api/user');

        $response
            ->assertOk()
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }
}
