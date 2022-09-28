<template>
  <b-container>
    <task-form class="my-4" :users="users" :key="formKey" @updated="listKey++" :task="task"></task-form>
    <task-list class="my-4" :users="users" :updated="listKey" @editTask="editTask"></task-list>
  </b-container>
</template>

<script>
import { fetchUsers } from '../../user'

export default {
    data() {
        return {
          listKey: 0,
          formKey: -1,
          task: {},
          users: []
        }
    },
    methods: {
      editTask(data) {
        this.task = data
        this.formKey--
      }
    },
    mounted() {
      axios.get('/sanctum/csrf-cookie').then(response => { 
            fetchUsers().then((resp) => {
                this.users = resp?.data?.map((user) => {
                    return {
                        value: user.id,
                        text: user.name
                    }
                })
            })
        })
    }
}
</script>

<style>

</style>