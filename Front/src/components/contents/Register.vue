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
      username: '',
      password: '',
      token: '',
      url: 'api/register'
    }
  },
  methods: {
    register () {
      let params = new URLSearchParams()
      params.append('name', this.username)
      params.append('password', this.password)
      let token = Math.random().toString(32).substring(2)
      this.token = token
      params.append('token', this.token)

      axios.post(this.url, params)
        .then((res) => {
          // ログイン成功！
          alert('登録が完了しました。ログインページに遷移します。')
          this.$router.push({ name: 'top' })
        })
        .catch((err) => {
          // ログイン失敗
          alert('登録に失敗しました。入力を確認してください')
          console.log(err)
        })
    }
  }
}

</script>
