## アイデア

TW的なPRG作るよ

## 決まってること

- SPA(Laravel / Vue / ts / docker)

## Vue 3 + ts
### インストールはこちらを利用
[インストール](https://px-wing.hatenablog.com/entry/2020/11/12/065719)

[【メモ】Vue CLI でホットリロードが効かない](https://qiita.com/ntm718/items/6023b0063f78d53192a1)

### Router

`npm install vue-router@4`

`vue add router`

## デプロイ構成

[デプロイ構成](https://s8a.jp/vue-js-github-aws-s3-auto-deploy)

## Docker高速化

WSLを採用した場合、通常通りDドライブなどのローカルでdockerを起動した場合 WSLはWinとLinuxのファイル変換を双方向で行う。この変換が非常に重いため WSLの中の /home/***/... に配置するのが望ましい。

マウントされているのは `\\wsl$` というネットワークドライブ。 その中にWSLに入れてるOSディレクトリがあるため、そこにコピーしてけばOK

## 権限変更

WSL上で動かしているためWSLのターミナルからchmodなど叩かないといけない。

## set up
### js
#### wsl
```bash
docker-compose exec rpg-front bash
```

#### docker
```bash
vue create eduit-rpg
```

### laravel

```bash
docker-compose exec rpg-app composer create-project --prefer-dist "laravel/laravel=6.*" .
docker-compose exec rpg-app chmod 777 -R storage
```
## ビルトインサーバ起動方法
### js
#### wsl
```bash
docker-compose exec rpg-front sh
```

#### docker
```bash
cd eduit-rpg
npm run serve
```