<template>
    <v-container>
        <v-row justify="center">
            <div>
                <v-card class="card mt-16" flat width="500">
                    <v-card-title
                    class="font-weigth-bold teal lighten-5"
                    justify="center"
                    align-content="center"
                    >
                    <span class="font-weight-bold">新規ユーザー登録</span>
                    </v-card-title>

                    <v-text-field
                    v-model="userName"
                    input
                    type="text"
                    name="userName"
                    label="ユーザー名"
                    hint="ユーザー名を入力してください"
                    required
                    ></v-text-field>

                    <v-text-field
                    v-model.trim="password"
                    type="password"
                    name="password"
                    label="パスワード"
                    hint="パスワードを入力してください。(空白文字は無効になります)"
                    :counter="maxPassLength"
                    :counter-value="v => v.trim().length"
                    :rules="rules"
                    required
                    ></v-text-field>

                    <div class="mt-8">
                          <v-btn
                          class="login"
                          color="teal"
                          block
                          large
                          elevation="2"
                          @click="register"
                          >
                          <span class="white--text font-weight-bold">新規登録</span>
                          </v-btn>
                    </div>
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
      userName: '',
      password: '',
      maxPassLength: 8, // パスワードの最大値
      rules: [v => v.trim().length <= 8 || 'パスワードは最大8文字までです。'], // パスワードルール
      token: '',
      url: 'api/register'
    }
  },
  methods: {
    // ユーザー登録
    register () {
      // いずれかの値が不正ならelse以下へ
      if (this.password.length <= this.maxPassLength && this.password && this.userName) {
        let params = new URLSearchParams()
        params.append('name', this.userName)
        params.append('password', this.password)
        // 認証用トークンも仕込む
        let token = Math.random().toString(32).substring(2)
        this.token = token
        params.append('token', this.token)

        axios.post(this.url, params)
          .then((res) => {
            alert('登録が完了しました。ログインページに遷移します。')
            this.$router.push({ name: 'top' })
          })
          .catch((err) => {
            alert('登録に失敗しました。入力を確認してください')
            console.log(err)
          })
      } else {
        alert('error: 入力内容を確認してください')
      }
    }
  }
}

</script>
