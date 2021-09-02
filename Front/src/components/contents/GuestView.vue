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
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
                <v-card
                  class="d-flex justify-space-around mx-4"
                  flat
                  tile
                >
                    <v-btn
                    class="login teal mt-16 px-14 white--text font-weight-bold"
                    inlineblock
                    large
                    elevation="2"
                    v-bind:to="{name: 'Top'}">
                    ログイン
                    </v-btn>

                    <v-btn
                    class="login teal mt-16 px-16 white--text font-weight-bold"
                    inlineblock
                    large
                    elevation="2"
                    v-bind:to="{name: 'register'}">
                    ユーザー登録
                    </v-btn>
                </v-card>
        </v-col>
    </v-row>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
axios.defaults.baseURL = 'http://localhost:78'

export default {
  data: function () {
    return {
      messages: [],
      url: 'api/messages/'
    }
  },
  methods: {
    getMessages () {
      axios.get(this.url)
        .then((res) => {
          this.messages = res.data
          this.messages.forEach(message => {
            message.created_at = moment(message.created_at).format('YYYY年MM月DD日 HH時mm分')
          })
        })
    }
  },
  mounted () {
    this.getMessages()
  }
}

</script>
