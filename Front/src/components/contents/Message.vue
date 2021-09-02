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
                                <v-btn
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
                        <v-text-field
                          v-model="newMessage.name"
                          label="Name"
                          height="20px"
                          required
                        ></v-text-field>
                        <v-text-field
                          v-model="newMessage.body"
                          label="Content"
                          height="100px"
                          required
                        ></v-text-field>
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
                        v-bind:to="{name: 'top'}">
                        ログアウト
                        </v-btn>
                        </v-card>
                    </form>
                  </div>
              </v-col>
            </v-row>
        </v-col>
    </v-row>
</template>

<script>

import {axios, moment} from '../../router/index'

export default {
  data: function () {
    return {
      messages: [],
      newMessage: [],
      url: 'api/messages/'
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
      axios.delete(this.url + id)
        .then((res) => {
          this.getMessages()
        })
    },
    // 投稿追加
    submit () {
      let params = new URLSearchParams()
      params.append('name', this.newMessage.name)
      params.append('body', this.newMessage.body)

      axios.post(this.url, params)
        .then((res) => {
          this.newMessage = []
          this.getMessages()
        })
    }
  },
  mounted () {
    this.getMessages()
  }
}
</script>
