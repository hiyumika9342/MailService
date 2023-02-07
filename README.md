メール一斉送信サービス
-------------------------

# ローカル環境構築

## 環境設定

### .envの作成
* .env.exampleをコピーして.envを作成。
* 以下のコマンドでAPP_KEYを設定
```shell
$ php artisan key:generate
```

### mail-service-docker/.envの作成
* mail-service-docker/.env.exampleをコピーしてmail-service-docker/.envを作成。
  内容は適当に変更する。

## Docker起動

```shell
$ cd mail-service-docker
$ docker compose up -d
```

## ビルド

コンテナ内でcomposer,npmのインストールおよびビルド。

```shell
$ docker exec -it web bash
$ composer install
$ npm install
$ npm run build
```

## 起動確認

```
http://localhost/
```
