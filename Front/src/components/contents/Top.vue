<template>
    <v-container>
        <v-row class="text-center" justify="center">
            <v-col class="mb-10 mt-10">
                <h1 class="mt-6 mb-6 teal--text">Welcome to Chat App</h1>
                <p>
                    <span class="font-weight-bold">ゲストログインでチャットを閲覧できます。<br></span>
                    <small class="grey--text">※ゲストログイン時は投稿機能が制限されます</small>
                </p>
            </v-col>
        </v-row>

        <v-row justify="center">
            <div>
                <v-card class="card" flat width="540">
                    <v-card-title
                    class="font-weigth-bold teal lighten-5"
                    justify="center"
                    align-content="center"
                    >
                    <span class="font-weight-bold">ログイン</span>
                    </v-card-title>

                    <v-text-field
                    v-model.trim="userName"
                    input
                    type="text"
                    name="userName"
                    label="ユーザー名"
                    hint="ユーザー名を入力してください"
                    required
                    autofocus
                    ></v-text-field>

                    <v-text-field
                    v-model.trim="password"
                    type="password"
                    name="password"
                    label="パスワード"
                    hint="パスワードを入力してください"
                    :counter="maxPassLength"
                    :counter-value="v => v.trim().length"
                    :rules="rules"
                    required
                    ></v-text-field>
                    <small class="red--text" v-show="loginCheck">
                      メールアドレスかパスワードが間違っています
                    </small>
                    <div class="mt-4">
                          <v-btn
                          class="login"
                          color="teal"
                          block
                          large
                          elevation="2"
                          @click="login"
                          >
                          <span class="white--text font-weight-bold">ログイン</span>
                          </v-btn>
                    </div>

                    <v-card
                      class="d-flex justify-space-between"
                      flat
                      tile
                    >
                        <v-btn
                        class="login teal lighten-3 mt-4 px-14 white--text font-weight-bold"
                        inlineblock
                        large
                        elevation="2"
                        v-bind:to="{name: 'guest'}">
                        ゲストログイン
                        </v-btn>

                        <v-btn
                        class="login teal mt-4 px-16 white--text font-weight-bold"
                        inlineblock
                        large
                        elevation="2"
                        v-bind:to="{name: 'register'}">
                        ユーザー登録
                        </v-btn>
                    </v-card>
                </v-card>
            </div>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios'

export default {
  data: function () {
    return {
      userName: '',
      password: '',
      token: '',
      maxPassLength: 8, // パスワードの最大値
      rules: [v => v.trim().length <= 8 || 'パスワードは最大8文字までです。'], // パスワードルール
      loginCheck: false,
      url: 'api/login/'
    }
  },
  methods: {
    login () {
      let params = new URLSearchParams()
      params.append('name', this.userName)
      params.append('password', this.password)

      axios.post(this.url, params)
        .then((res) => {
          // トークンと名前の値をMessage.vueへ渡す
          this.token = res.data.token
          this.$router.push({ name: 'chat', params: {token: this.token, userName: this.userName} })
        })
        // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          this.loginCheck = true
        })
    }
  }
}

</script>
