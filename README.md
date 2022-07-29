# laravel8-boilerplate
Laravel 8 を REATful API リソースサーバーとしたアプリの雛形です。

## 開発環境のセットアップ
```bash
cp .env.docker-compose_example .env
docker-compose up -d

docker-compose exec --user=app app bash
cd laravel/
composer install
php artisan migrate
```

## 開発
### ユニットテスト
```bash
php artisan test
```

### 静的解析
```bash
vendor/bin/phpstan --memory-limit=-1

npm run lint
```

### フォーマット
```bash
vendor/bin/php-cs-fixer fix

npm run format
```

## TODO リスト
- [ ] プロフィール概要更新。同じメールアドレスでもバリデーションエラーとならないようにする
- [ ] プロフィール概要更新。バリデーションエラー時の属性名を日本語にする。
    - [ ] nameは必ず指定してください。
    - [ ] emailの値は既に存在しています。
- [ ] プロフィール概要更新。メールアドレス変更時はverifyが必要？
    - ~~メールアドレスは別タブ、別APIで更新するべき？~~ ユーザー更新APIでemail更新時はemail_verified_atをリセットしてverifyメール送信
- [ ] プロフィールパスワード変更。現在のパスワードを間違えた場合のメッセージが全部英語なので日本語にしたい。
- [ ] マイグレーションしてからの ide-helpler 実行してモデルの PHPDoc を自動生成する。
- [ ] フォーム部分コンポーネント化する
- [ ] ログインを記憶する、を実装する。
- [ ] 未ログイン時はログインページへリダイレクトする
- [ ] ファイル名を変更する？ ShowPassword → PasswordShow. Show. Edit などは最後につける。
- [ ] 最初のユーザー作成コマンドを作る。
- [ ] ログインページ `laravel/resources/js/views/Login.vue` のスタイルを適切にする。現在、 [Signin Template · Bootstrap v5.0](https://getbootstrap.jp/docs/5.0/examples/sign-in/) をベースにしたが、 `<body>` のスタイルが適用できていない。
