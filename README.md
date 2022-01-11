# laravel8-boilerplate
Laravel 8 を REATful API リソースサーバーとしたアプリの雛形です。

## TODO
- [ ] Vue.js 3 を SPA フロントエンドとしたアプリの雛形にする。

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
