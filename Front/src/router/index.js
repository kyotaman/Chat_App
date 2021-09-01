import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Message from '@/components/Message'
import MessageShow from '@/components/MessageShow'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/chat',
      name: 'chat',
      component: Message
    },
    {
      path: '/chat/:messageId',
      name: 'chat.show',
      component: MessageShow,
      props: true
    }
  ]
})
