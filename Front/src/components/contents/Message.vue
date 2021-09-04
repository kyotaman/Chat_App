<template>
    <v-row align="center" justify="center">
        <v-col>
            <v-simple-table
              fixed-header
              height="450px"
              class="mt-8 mb-6 mx-4"
            >
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left teal lighten-5">
                              ID
                            </th>
                            <th class="text-left teal lighten-5">
                              Content
                            </th>
                            <th class="text-left teal lighten-5">
                              Send by
                            </th>
                            <th class="text-left teal lighten-5">
                              Created at
                            </th>
                            <th class="text-left teal lighten-5">
                              Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                          v-for="(message, index) in messages"
                          :key="index"
                        >
                            <td>{{ message.id }}</td>
                            <td>{{ message.body }}</td>
                            <td>{{ message.name }}</td>
                            <td>{{ message.created_at }}</td>
                            <td>
                              <!-- ログインユーザーの投稿にのみ削除ボタンを設置 -->
                                <v-btn
                                  v-if="message.name === MessageName"
                                  class="deep-orange white--text"
                                  inlineblock
                                  @click="deleteMessage(message.id)">
                                  削除
                                  </v-btn>

                            </td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>

            <v-row>
              <v-col>
                  <div class="mx-10">
                      <form>
                        <!-- ユーザー名埋め込み 変更不可にする -->
                        <v-text-field
                        class="font-weight-bold"
                          v-model="MessageName"
                          label="Name"
                          height="20px"
                          readonly
                          required
                        ></v-text-field>

                        <v-text-field
                          class="font-weight-bold"
                          v-model.trim="MessageBody"
                          label="Content"
                          height="100px"
                          required
                        ></v-text-field>
                          <!-- 投稿送信エラー時に表示↓ -->
                        <p v-show="sendCheck" class="red--text">送信エラー：入力内容を確認してください</p>

                        <v-card
                          class="d-flex justify-space-between"
                          flat
                          tile
                        >
                        <v-btn
                          class="teal white--text font-weight-bold mt-10 mb-4 px-12"
                          inlineblock
                          @click="submit"
                        >
                          送信
                        </v-btn>
                        <v-btn
                        class="teal lighten-3  white--text font-weight-bold mt-10 mb-4 px-12"
                        inlineblock
                        @click="logout"
                        >
                        ログアウト
                        </v-btn>
                        </v-card>
                    </form>
                  </div>
              </v-col>
            </v-row>
            <!-- 投稿＆削除完了バー↓ -->
            <div class="text-center">
              <v-snackbar
                v-model="deleteBar"
                :timeout="timeout"
                :multi-line="multiLine"
                color="teal lighten-1"
                centered
              >
                投稿を削除しました。
              </v-snackbar>
            </div>

            <div class="text-center">
              <v-snackbar
                v-model="sendBar"
                :timeout="timeout"
                :multi-line="multiLine"
                color="teal lighten-1"
                centered
              >
                投稿を反映しました。
              </v-snackbar>
            </div>

        </v-col>
    </v-row>
</template>

<script>

import {axios, moment} from '../../router/index'

export default {
  props: ['token', 'userName'],
  data: function () {
    return {
      messages: [],
      MessageName: '',
      MessageBody: '',
      userToken: '',
      sendCheck: false,
      deleteBar: false,
      sendBar: false,
      multiLine: true,
      timeout: 1300,
      url: 'api/messages/'
    }
  },
  watch: {
    token: function () {
      localStorage.setItem('userToken', JSON.stringify(this.userToken))
    }
  },
  methods: {
    // 投稿取得
    getMessages () {
      axios.get(this.url)
        .then((res) => {
          this.messages = res.data
          // 投稿日時の表記調整↓
          this.messages.forEach(message => {
            message.created_at = moment(message.created_at).format('YYYY年MM月DD日 HH時mm分')
          })
        })
    },
    // 投稿削除
    deleteMessage (id) {
      if (confirm('投稿を削除しますか？')) {
        axios.delete(this.url + id)
          .then((res) => {
            this.deleteBarDisplay()
            this.getMessages()
          })
      }
    },
    // 投稿追加
    submit () {
      // 両方に空白以外の値があれば送信する。エラー時はelse以下
      if (this.MessageName && this.MessageBody) {
        let params = new URLSearchParams()
        params.append('name', this.MessageName)
        params.append('body', this.MessageBody)

        axios.post(this.url, params)
          .then((res) => {
            this.MessageBody = ''
            this.sendCheck = false
            this.sendBar = true
            this.getMessages()
          }).catch((err) => {
            //  APIが通らなかった時
            alert('正常に送信できませんでした。')
            console.log(err)
          })
      } else {
        this.sendCheck = true
      }
    },
    // ログアウト
    logout () {
      localStorage.clear()
      alert('ログアウトしました。')
      this.$router.push({ name: 'top' })
    },
    // 削除完了バーの表示処理
    deleteBarDisplay () {
      this.deleteBar = true
    },
    // 投稿追加完了バーの表示処理
    sendBarDisplay () {
      this.sendBar = true
    }
  },
  mounted () {
    this.userToken = this.token || JSON.parse(localStorage.getItem('userToken'))
    this.MessageName = this.userName || JSON.parse(localStorage.getItem('userName'))
    // トークンと名前が両方ある場合のみページ表示
    if (!this.userToken || !this.MessageName) {
      this.$router.push({ name: 'top' })
    } else {
      this.getMessages()
      // リロードしても情報を保持するため、保存
      localStorage.setItem('userName', JSON.stringify(this.MessageName))
      localStorage.setItem('userToken', JSON.stringify(this.userToken))
    }
  }
}
</script>
