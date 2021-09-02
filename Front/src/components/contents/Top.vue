<template>
    <v-container>
        <v-row class="text-center" justify="center">
            <v-col class="mb-10 mt-10">
                <v-card outlined>
                    <h1 class="mt-6 mb-6">Welcome to Chat App</h1>
                    <p>
                        ゲストログインでチャット内容を閲覧できます。<br>
                        （投稿はできません）
                    </p>
                </v-card>
            </v-col>
        </v-row>

        <v-row justify="center">
            <div>
                <v-card class="card" flat width="540">
                    <v-card-title
                    class="font-weigth-bold teal lighten-5"
                    justify="center"
                    align-content="center"
                    >ログイン
                    </v-card-title>

                    <v-text-field
                    input
                    type="text"
                    name="username"
                    label="ユーザー名"
                    hint="ユーザー名を入力してください"
                    required
                    v-model="username"
                    ></v-text-field>

                    <v-text-field
                    type="password"
                    name="password"
                    label="パスワード"
                    hint="パスワードを入力してください。(8桁)"
                    :counter="8"
                    required
                    v-model="password"
                    ></v-text-field>

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
axios.defaults.baseURL = 'http://localhost:78'

export default {
  data: function () {
    return {
      username: '',
      password: '',
      url: 'api/user/'
    }
  },
  methods: {
    login () {
      var params = {
        username: this.username,
        password: this.password
      }
      axios.post('/login', params)
        .then((res) => {

          // ログイン成功！

        })
        .catch((err) => {
          // ログイン失敗
          console.log(err)
        })
    }
  }
}

</script>
