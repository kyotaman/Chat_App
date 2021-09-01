<template>
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Content</th>
                <th scope="col">Send by</th>
                <th scope="col">Show</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(message, index) in messages" :key="index">
                <th scope="row">{{ message.id }}</th>
                <td>{{ message.body }}</td>
                <td>{{ message.name }}</td>
                <td>
                    <router-link v-bind:to="{name: 'chat.show', params: {messageId: message.id }}">
                        <button>show</button>
                    </router-link>
                </td>
                <td>
                    <router-link v-bind:to="{name: 'chat.edit', params: {messageId: message.id }}">
                        <button>edit</button>
                    </router-link>
                </td>
                <td>
                    <button v-on:click="deleteMessage(message.id)">delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <form v-on:submit.prevent="submit">
                <div>
                    <label for="content">Content</label>
                    <textarea id="content" v-model="newMessage.body"></textarea>
                </div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" v-model="newMessage.name">
                </div>
              <button type="submit">Submit</button>
          </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:78'
// axios.defaults.headers.post['Content-Type'] = 'application/json'
// axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*'

export default {
  data: function () {
    return {
      messages: [],
      newMessage: [],
      url: 'api/messages/'
    }
  },
  methods: {
    getMessages () {
      axios.get(this.url)
        .then((res) => {
          this.messages = res.data
        })
    },
    deleteMessage (id) {
      axios.delete(this.url + id)
        .then((res) => {
          this.getMessages()
        })
    },
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
