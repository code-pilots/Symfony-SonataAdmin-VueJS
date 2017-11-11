import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/lib/buefy.css'
import Hello from './components/Hello.vue'

Vue.use(Buefy)

Vue.component('hello', Hello)

new Vue({
    el: '#app'
})