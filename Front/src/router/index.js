import Vue from 'vue'
import Router from 'vue-router'

import Top from '@/components/contents/Top'
import Header from '@/components/common/Header'
import Footer from '@/components/common/Footer'
import Message from '@/components/contents/Message'
import GuestView from '@/components/contents/GuestView'
import Register from '@/components/contents/Register'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Top',
      component: Top
    },
    {
      path: '/chat',
      name: 'chat',
      component: Message
    },
    {
      path: '/guest',
      name: 'guest',
      component: GuestView
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    }
  ]
})

Vue.component('header-component', Header)
Vue.component('footer-component', Footer)
