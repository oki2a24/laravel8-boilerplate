<?php

namespace Tests\Feature\Requests\PasswordResetLink;

use App\Http\Requests\PasswordResetLink\StoreRequest;
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
                    'email' => null,
                ],
                [
                    'email' => ['Required' => []],
                ],
            ],
            'タイプエラーとなること' => [
                [
                    'email' => true,
                ],
                [
                    'email' => ['String' => [], 'Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
            '最大数エラーとなること' => [
                [
                    'email' => str_repeat('a', 256 - 12) . '@example.com',
                ],
                [
                    'email' => ['Max' => [255], 'Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
            'emailフォーマットエラーとなること' => [
                [
                    'email' => 'dame@@example.com',
                ],
                [
                    'email' => ['Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
        ];
    }
}
