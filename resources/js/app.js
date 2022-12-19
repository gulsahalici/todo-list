import './bootstrap';

import Vue from 'vue'

import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

import TaskList from './components/task/List'
import TaskForm from './components/task/Form'
import Layout from './components/layouts/Default'

const options = {
    // You can set your default options here
}

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(Toast, options)

Vue.component('task-list', TaskList)
Vue.component('task-form', TaskForm)
Vue.component('layout', Layout)

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({ el, App, props, plugin }) {
      Vue.use(plugin)
  
      new Vue({
        render: h => h(App, props),
      }).$mount(el)
    },
  })

InertiaProgress.init({
    color: 'red',
    showSpinner: true
})


/*
import Tasks from './components/task/Index'
Vue.component('tasks', Tasks)
*/