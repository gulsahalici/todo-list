import './bootstrap';

import Vue from 'vue'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import LoginForm from './components/auth/LoginForm'
Vue.component('login-form', LoginForm)

import RegisterForm from './components/auth/RegisterForm'
Vue.component('register-form', RegisterForm)

import Tasks from './components/task/Index'
Vue.component('tasks', Tasks)

import TaskList from './components/task/List'
Vue.component('task-list', TaskList)

import TaskForm from './components/task/Form'
Vue.component('task-form', TaskForm)

import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

const options = {
    // You can set your default options here
}

Vue.use(Toast, options)

const app = new Vue({
    el: '#app'
})

