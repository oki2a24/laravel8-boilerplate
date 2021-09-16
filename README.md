# template_laravel8_vue3
Laravel 8 を REATful API リソースサーバーとし、 Vue.js 3 を SPA フロントエンドとしたアプリの雛形です。

## 開発環境のセットアップ
`composer create-project` は対象ディレクトリが空以外の場合は失敗するため、一度適当なディレクトリにインストール後、移動しています。

```bash
cp .env.docker-compose_example .env
docker-compose up -d
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
