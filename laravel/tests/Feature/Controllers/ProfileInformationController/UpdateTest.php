<?php

namespace Tests\Feature\Controllers\ProfileInformationController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function 認証中ユーザーのプロフィールを更新できること(): void
    {
        /** @var User */
        $user = User::factory()->create();
        $data = [
            'name' => '更新後の氏名',
            'email' => 'update.profile@example.com',
        ];

        $response = $this
            ->actingAs($user)
            ->putJson('/api/user/profile-information', $data);

        $response
            ->assertOk()
            ->assertJson($data);
        $this->assertDatabaseHas('users', $data);
    }
}
