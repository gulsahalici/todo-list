<template>
    <b-container>
      <layout :user="user"/>
      <b-row>
        <b-col></b-col>
        <b-col class="text-center">
          <h3>ToDo List</h3>
        </b-col>
        <b-col>
          <b-button v-b-modal="'task-form-modal'" class="float-right" variant="primary">Create New Task</b-button>
  
          <b-modal id="task-form-modal" ref="task-form-modal" size="lg" :title="task.id ? 'Edit Task' : 'New Task'" @hidden="updateList" hide-footer>
            <task-form class="my-4" :users="users" @updated="hideModal" :task="task"></task-form>
          </b-modal>
        </b-col>
      </b-row>
      <task-list class="my-4" :users="users" :tasks="tasks.data" :pagination="pagination" :updated="listKey" @editTask="editTask"></task-list>
    </b-container>
  </template>
  
  <script>
  import layout from '../../components/layouts/Default.vue'
  
  export default {
    props: ['user', 'userList', 'tasks', 'pagination'],
    components: {
      layout
    },
    data() {
      return {
        listKey: 0,
        formKey: -1,
        task: {}
      }
    },
    computed: {
      users() {
        return this.userList?.map((user) => {
          return {
            value: user.id,
            text: user.name
          }
        })
      }
    },
    methods: {
      editTask(data) {
        this.task = data
        this.formKey--
        this.$refs['task-form-modal'].show()
      },
      hideModal() {
        this.$refs['task-form-modal'].hide()
      },
      updateList() {
        this.listKey++
        this.task = {}
      }
    }
  }
  </script>
  