# name
Chat_App

# discription
ユーザー認証機能、CRUD機能を実装した簡潔なチャットアプリです。
フロントエンドはVue.js
バックエンドはPHP(Laravel)
で作成しています。
バックエンドのみdocker環境を使用しました。

# setting
環境構築手順 (参考環境:Mac OS11.4 M1チップ)

_1._  
Chat_App/API ディレクトリ直下にあるdocker-compose.ymlを確認してください。  
いくつかの項目で環境変数を指定しているので、必要に応じて.envファイルを作成するか、
docker-compose.ymlを書き換えてください。  

_【注意】_  
DB_DATABASE=chat_app  となっている部分は書き換えないでください。  
動作確認に必要なテーブルやデータが既に入っています。



_2._  
コマンドラインでChat_App/API ディレクトリに移動し、  
`% docker compose up -d --build`  
を入力してdockerを起動します。  



_3._  
`% docker compose exec app ash`  
を入力し、appコンテナへ移動します。  
appコンテナ上で`% composer install` と `% npm install`を入力します。  
その後、`% php artisan key:generate`を入力します。  



_4._  
Chat_App/API/src ディレクトリ直下に.envファイルを作成します。  
同階層に置かれている.envexampleをコピー＆ペーストし、12~14行目を修正します。  
Chat_App/API/.envと合致するように修正してください。  

_【注意】_  
ここでもDB_DATABASE=chat_app を指定してください.  



_5._  
コマンドラインでChat_App/Front ディレクトリへ移動します。  
`% npm install` を入力します。  

_補足_  
手順1の段階でAPI側のweb-portを変更している場合は、  
Chat_App/Front/router/index.jsを確認し、axiosのBaseURLを適宜変更してください。  



_6._  
Chat_App/Front上で`% npm run dev` を入力したのち、  
localhostへアクセスし接続を確認してください。
