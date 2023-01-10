import Vue from 'vue'
import { createRenderer } from 'vue-server-renderer'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import createServer from '@inertiajs/server'

import './bootstrap';
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


createServer((page) => createInertiaApp({
  page,
  render: createRenderer().renderToString,
  resolve: name => {
    console.log(name)
    return require(`./Pages/${name}`)
  },
  setup({ app, props, plugin }) {
    Vue.use(plugin)
    return new Vue({
      render: h => h(app, props),
    })
  },
}))