# name

Chat_App


# discription

ユーザー認証機能、CRUD機能を実装した簡潔なチャットアプリです。  
フロントエンドはVue.js  
バックエンドはPHP(Laravel)  
で作成しています。
バックエンドのみdocker環境を使用しました。  

_使用ライブラリ_  
・axios.js  
・moment.js  
・Vuetify  

# function

_実装した機能_  

・ユーザー認証(新規登録、ログイン、ログアウト)  
・外部APIによるCRUD操作(Read, Delete)  

※delete機能はユーザー認証と連携し、ログインユーザーの投稿のみ削除できる設定にしています。

# setting

環境再現手順 (参考環境:Mac OS11.4 M1チップ)  

_1._  
Chat_App/API ディレクトリ直下にあるdocker-compose.ymlを確認してください。  
いくつかの項目で環境変数を指定しているので、必要に応じて.envファイルを作成するか、
docker-compose.ymlを書き換えてください。  




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

_【補足】_  
Chat_App/APIディレクトリ上で  
`% docker exec db bash` を入力することでDBコンテナへ入ることができます。  
・.envで指定したDATABASEが存在すること  
・指定したDB内にaccounts テーブル, messages テーブルが存在すること  
を確認しておいてください。  

存在しない場合は、Chat_App/API/src/database/migrationsディレクトリを参考に作成してください。


_5._  
コマンドラインでChat_App/Front ディレクトリへ移動します。  
`% npm install` を入力します。  

_補足_  
手順1の段階でAPI側のweb-portを変更している場合は、  
Chat_App/Front/router/index.jsを確認し、axiosのBaseURLを適宜変更してください。  



_6._  
Chat_App/Front上で`% npm run dev` を入力したのち、  
localhostへアクセスし接続を確認してください。
