<template>
    <b-container>
      <layout :user="user"/>
      <b-row>
        <b-col></b-col>
        <b-col class="text-center">
          <h3>Tasks</h3>
        </b-col>
        <b-col>
          <b-button v-b-modal="'task-form-modal'" class="float-right" size="sm" variant="info">+ New Task</b-button>
  
          <b-modal id="task-form-modal" ref="task-form-modal" size="lg" :title="task.id ? 'Edit Task' : 'New Task'" @hidden="updateList" hide-footer>
            <task-form class="my-4" :users="users" @createTask="createTask" @updateTask="updateTask" :task="task"></task-form>
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
        task: {},
        form: this.$inertia.form({
          description: null,
          user_id: null
        })
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
      createTask(data) {
        this.form.description = data.description
        this.form.user_id = data.user_id
        this.form.post('/tasks')

        this.$refs['task-form-modal'].hide()

        this.$toast.success('Task created.', {
          timeout: 5000
        })
      },
      updateTask(data) {
        this.form.id = data.id
        this.form.description = data.description
        this.form.user_id = data.user_id
        this.form.put('/tasks/' + this.form.id)

        this.$refs['task-form-modal'].hide()

        this.$toast.success('Task updated.', {
          timeout: 5000
        })
      },
      editTask(data) {
        this.task = data
        this.formKey--
        this.$refs['task-form-modal'].show()
      },
      hideModal(data) {
        this.$refs['task-form-modal'].hide()
      },
      updateList() {
       // this.listKey++
        this.task = {}
      }
    }
  }
  </script>
  