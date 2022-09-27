<template>
  <b-container>
    <task-form class="my-2" :key="formKey" @updated="listKey++" :task="task"></task-form>
    <task-list class="my-2" :key="listKey" @editTask="editTask"></task-list>
  </b-container>
</template>

<script>
export default {
    data() {
        return {
          listKey: 0,
          formKey: -1,
          task: {}
        }
    },
    methods: {
      editTask(data) {
        this.task = data
        this.formKey--
      }
    }
}
</script>

<style>

</style>