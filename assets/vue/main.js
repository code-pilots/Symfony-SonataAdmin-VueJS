import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/lib/buefy.css'
import Hello from './components/Hello.vue'
import Calendar from './components/Calendar.vue'

Vue.use(Buefy)

Vue.component('hello', Hello)
Vue.component('calendar', Calendar)

new Vue({
    el: '#app'
})