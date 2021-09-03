<template>
    <div>
        <form>
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" id="id" readonly v-model="message.id">
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-3 col-form-label">Send by</label>
                <input type="text" readonly id="name" v-model="message.name">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" readonly id="content" v-model="message.body">
            </div>
            <div class="form-group">
                <label for="time">Created at</label>
                <input type="text" readonly id="time" v-model="message.created_at">
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
axios.defaults.baseURL = 'http://localhost:78'

export default {
  props: {
    messageId: [String, Number]
  },
  data: function () {
    return {
      message: {},
      url: 'api/messages/'
    }
  },
  methods: {
    getMessage () {
      axios.get(this.url + this.messageId)
        .then((res) => {
          this.message = res.data
          this.message.created_at = moment(this.message.created_at).format('YYYY年MM月DD日 HH時mm分s秒')
        })
    }
  },
  mounted () {
    this.getMessage()
  }
}
</script>
