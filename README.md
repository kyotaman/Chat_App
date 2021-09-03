# Chat_App
my trainings of API &amp; Vue.js


APIディレクトリ、Frontディレクトリそれぞれに
セットアップが必要です。

・Front Set up
``` bash
#first
% npm install

#second
% npm run dev

#third
index.jsにて接続先BaseURLの設定

・API Set up

#first
.envを使用環境によって変更してください

#second
% docker compose up -d --build

#third
% docker compose exec app ash
でappコンテナに入り、php artisanコマンドで必要に応じてmigratiton,seedを設定してください

※accounts, messagesテーブルが必要です。

#final
appコンテナ上で
npm install
