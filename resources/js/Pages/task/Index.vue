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

        <b-modal id="task-form-modal" ref="task-form-modal" size="lg" :title="task.id ? 'Edit Task' : 'New Task'" @hidden="task={}" hide-footer>
          <task-form class="my-4" :users="users" :task="task" @update="showMessage"></task-form>
        </b-modal>
      </b-col>
    </b-row>
    <task-list class="my-4" :users="users" :tasks="tasks.data" :pagination="pagination" @editTask="editTask" @update="showMessage"></task-list>
  </b-container>
</template>
  
<script>
export default {
  props: ['user', 'userList', 'tasks', 'pagination'],
  data() {
    return {
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
    showMessage(msg) {
      this.$refs['task-form-modal'].hide()

      this.$toast.success(msg, {
        timeout: 5000
      })
    },
    editTask(data) {
      this.task = data
      this.$refs['task-form-modal'].show()
    }
  }
}
</script>
  