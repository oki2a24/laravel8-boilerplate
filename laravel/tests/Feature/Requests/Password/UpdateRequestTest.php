<?php

namespace Tests\Feature\Requests\Password;

use App\Http\Requests\Password\UpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        /** @var User */
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /**
     * @test
     * @dataProvider dataProvider
     * @return void
     */
    public function エラーとなること(array $data, array $failedValidationRules): void
    {
        // 実行
        $request = UpdateRequest::createFromBase(Request::create('/', Request::METHOD_POST, $data));
        $validator = Validator::make($request->all(), $request->rules());

        // 確認。成否
        $this->assertTrue($validator->fails());
        // 確認。失敗内容
        $this->assertEquals($failedValidationRules, $validator->failed());
    }

    /**
     * データプロバイダとしてテストに与えるデータを返します。
     */
    public function dataProvider()
    {
        return [
            '必須エラーとなること' => [
                [
                    'current_password' => null,
                    'password' => null,
                ],
                [
                    'current_password' => ['Required' => []],
                    'password' => ['Required' => []],
                ],
            ],
            'タイプエラーとなること' => [
                [
                    'current_password' => true,
                    'password' => 11111111,
                ],
                [
                    'current_password' => [
                        'String' => [],
                        'CurrentPassword' => [],
                    ],
                    'password' => [
                        'Illuminate\Validation\Rules\Password' => []
                    ],
                ],
            ],
            '最大数エラーとなること' => [
                [
                    'current_password' => str_repeat('a', 256),
                    'password' => str_repeat('a', 256),
                ],
                [
                    'current_password' => [
                        'Max' => [255],
                        'CurrentPassword' => [],
                    ],
                    'password' => ['Max' => [255]],
                ],
            ],
            '最低数エラーとなること' => [
                [
                    'current_password' => 'password',
                    'password' => 'aaaaaaa',
                ],
                [
                    'password' => ['Illuminate\Validation\Rules\Password' => []],
                ],
            ],
            'current_passwordエラーとなること' => [
                [
                    'current_password' => 'not-current-password',
                    'password' => 'newpassword',
                ],
                [
                    'current_password' => ['CurrentPassword' => []],
                ],
            ]
        ];
    }
}
