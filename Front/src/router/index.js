import Vue from 'vue'
import Router from 'vue-router'
import axios from 'axios'
import moment from 'moment'

import Top from '@/components/contents/Top'
import Header from '@/components/common/Header'
import Footer from '@/components/common/Footer'
import Message from '@/components/contents/Message'
import GuestView from '@/components/contents/GuestView'
import Register from '@/components/contents/Register'

Vue.use(Router)
Vue.component('header-component', Header)
Vue.component('footer-component', Footer)

axios.defaults.baseURL = 'http://localhost:78' // 接続先のAPIのURL
export {axios, moment}

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'top',
      component: Top
    },
    {
      path: '/chat',
      name: 'chat',
      component: Message,
      props: true
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
