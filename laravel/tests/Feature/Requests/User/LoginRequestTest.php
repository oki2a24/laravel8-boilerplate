<?php

namespace Tests\Feature\Requests\User;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataProvider
     * @return void
     */
    public function エラーとなること(array $data, array $failedValidationRules): void
    {
        // 実行
        $request = LoginRequest::createFromBase(Request::create('/', Request::METHOD_POST, $data));
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
                    'email' => null,
                    'password' => null,
                        ],
                [
                    'email' => ['Required' => []],
                    'password' => ['Required' => []],
                        ],
            ],
            'タイプエラーとなること' => [
                [
                    'email' => true,
                    'password' => 11111111,
                ],
                [
                    'email' => ['String' => [], 'Email' => ['rfc', 'strict', 'spoof']],
                    'password' => [
                        'Illuminate\Validation\Rules\Password' => []
                    ],
                ],
            ],
            '最低数エラーとなること' => [
                [
                    'email' => 'test@example.com',
                    'password' => 'aaaaaaa',
                ],
                [
                    'password' => ['Illuminate\Validation\Rules\Password' => []],
                ],
            ],
            'フォーマットエラーとなること' => [
                [
                    'email' => 'dame@@example.com',
                    'password' => 'password',
                ],
                [
                    'email' => ['Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
        ];
    }
}
