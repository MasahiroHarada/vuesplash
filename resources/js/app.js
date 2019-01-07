import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'

new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App />'
})
