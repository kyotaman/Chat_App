<template>
            <div>
                <form v-on:submit.prevent="submit">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" readonly id="id" v-model="message.id">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" v-model="message.name">
                    </div>
                    <div class="form-group">
                        <label for="body">Content</label>
                        <input type="text" id="body" v-model="message.body">
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
</template>

<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:78'

export default {
  props: {
    messageId: [String, Number]
  },
  data: function () {
    return {
      message: [],
      url: 'api/messages/'

    }
  },
  methods: {
    getMessage () {
      axios.get(this.url + this.messageId)
        .then((res) => {
          this.message = res.data
        })
    },
    submit () {
      axios.put('/api/messages/' + this.messageId, this.message)
        .then((res) => {
          this.$router.push({name: 'chat'})
        })
    }
  },
  mounted () {
    console.log(this.messageId)
    this.getMessage()
  }
}
</script>
