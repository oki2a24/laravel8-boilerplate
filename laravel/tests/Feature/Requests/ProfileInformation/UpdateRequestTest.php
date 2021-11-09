<?php

namespace Tests\Feature\Requests\ProfileInformation;

use App\Http\Requests\ProfileInformation\UpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateRequestTest extends TestCase
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
                    'name' => null,
                    'email' => null,
                ],
                [
                    'name' => ['Required' => []],
                    'email' => ['Required' => []],
                ],
            ],
            'タイプエラーとなること' => [
                [
                    'name' => true,
                    'email' => true,
                ],
                [
                    'name' => ['String' => []],
                    'email' => ['String' => [], 'Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
            '最大数エラーとなること' => [
                [
                    'name' => str_repeat('あ', 256),
                    'email' => str_repeat('a', 256 - 12) . '@example.com',
                ],
                [
                    'name' => ['Max' => [255]],
                    'email' => ['Max' => [255], 'Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
            'emailフォーマットエラーとなること' => [
                [
                    'name' => '試験太郎',
                    'email' => 'dame@@example.com',
                ],
                [
                    'email' => ['Email' => ['rfc', 'strict', 'spoof']],
                ],
            ],
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
        ];
        $failedValidationRules = [
            'email' => ['Unique' => ['users']],
        ];

        $this->エラーとなること($data, $failedValidationRules);
    }
}
