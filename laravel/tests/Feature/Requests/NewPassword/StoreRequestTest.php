<?php

namespace Tests\Feature\Requests\NewPassword;

use App\Http\Requests\NewPassword\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreRequestTest extends TestCase
{
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
                    'token' => null,
                    'email' => null,
                    'password' => null,
                    'password_confirmation' => null,
                ],
                [
                    'token' => ['Required' => []],
                    'email' => ['Required' => []],
                    'password' => ['Required' => []],
                ],
            ],
            'タイプエラーとなること' => [
                [
                    'token' => true,
                    'email' => true,
                    'password' => 11111111,
                    'password_confirmation' => 11111111,
                ],
                [
                    'token' => ['String' => []],
                    'email' => ['String' => [], 'Email' => ['rfc', 'strict', 'spoof']],
                    'password' => [
                        'Illuminate\Validation\Rules\Password' => []
                    ],
                ],
            ],
            '最大数エラーとなること' => [
                [
                    'token' => str_repeat('あ', 256),
                    'email' => str_repeat('a', 256 - 12) . '@example.com',
                    'password' => str_repeat('a', 256),
                    'password_confirmation' => str_repeat('a', 256),
                ],
                [
                    'email' => ['Max' => [255], 'Email' => ['rfc', 'strict', 'spoof']],
                    'password' => ['Max' => [255]],
                ],
            ],
            '最低数エラーとなること' => [
                [
                    'token' => 'token123',
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
                    'token' => 'token123',
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
                    'token' => 'token123',
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
}
