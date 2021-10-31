## アイデア

医療費控除金額計算アプリ

医療費控除 = medical expenses deduction

略して"med"をアプリ名（仮）とした

## 決まってること

- SPA(Laravel / Vue2 / ts / docker)

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
docker-compose exec med-front bash
```

#### docker
```bash
vue create med
```

### laravel

```bash
docker-compose exec med-app composer create-project --prefer-dist "laravel/laravel=6.*" .
docker-compose exec med-app chmod 777 -R storage
```
## ビルトインサーバ起動方法
### js
#### wsl
```bash
docker-compose exec med-front bash
```

#### docker
```bash
cd med
npm run serve
```