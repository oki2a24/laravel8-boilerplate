<?php

namespace Tests\Feature\Requests\RegisteredUser;

use App\Http\Requests\RegisteredUser\StoreRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider dataProvider
     * @return void
     */
    public function エラーとなること(array $data, array $failedValidationRules): void
    {
        // 実行
        $request = StoreRequest::createFromBase(Request::create('/', Request::METHOD_POST, $data));
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
                    'name' => null,
                    'email' => null,
                    'password' => null,
                    'password_confirmation' => null,
                ],
                [
                    'name' => ['Required' => []],
                    'email' => ['Required' => []],
                    'password' => ['Required' => []],
                ],
            ],
            'タイプエラーとなること' => [
                [
                    'name' => true,
                    'email' => true,
                    'password' => 11111111,
                    'password_confirmation' => 11111111,
                ],
                [
                    'name' => ['String' => []],
                    'email' => ['String' => [], 'Email' => ['rfc', 'strict', 'spoof']],
                    'password' => [
                        'Illuminate\Validation\Rules\Password' => []
                    ],
                ],
            ],
            '最大数エラーとなること' => [
                [
                    'name' => str_repeat('あ', 256),
                    'email' => str_repeat('a', 256 - 12) . '@example.com',
                    'password' => str_repeat('a', 256),
                    'password_confirmation' => str_repeat('a', 256),
                ],
                [
                    'name' => ['Max' => [255]],
                    'email' => ['Max' => [255], 'Email' => ['rfc', 'strict', 'spoof']],
                    'password' => ['Max' => [255]],
                ],
            ],
            '最低数エラーとなること' => [
                [
                    'name' => '試験太郎',
                    'email' => 'test@example.com',
                    'password' => 'aaaaaaa',
                    'password_confirmation' => 'aaaaaaa',
                ],
                [
                    'password' => ['Illuminate\Validation\Rules\Password' => []],
                ],
            ],
            'emailフォーマットエラーとなること' => [
                [
                    'name' => '試験太郎',
                    'email' => 'dame@@example.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
                [
                    'email' => ['Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
            'confirmedエラーとなること' => [
                [
                    'name' => '試験太郎',
                    'email' => 'test@example.com',
                    'password' => 'password1',
                    'password_confirmation' => 'password2',
                ],
                [
                    'password' => ['Confirmed' => []],
                ],
            ]
        ];
    }

    /**
     * @test
     * @return void
     */
    public function emailのユニークエラーとなること(): void
    {
        $user = User::factory()->create();
        $data = [
            'name' => '試験太郎',
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        $failedValidationRules = [
            'email' => ['Unique' => ['users']],
        ];

        $this->エラーとなること($data, $failedValidationRules);
    }
}
