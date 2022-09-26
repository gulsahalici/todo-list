<template>
  <b-container>
    <h4 class="text-center">Task List</h4>
    <task-form class="my-2" @updated="listKey++"></task-form>
    <task-list class="my-2" :key="listKey"></task-list>
  </b-container>
</template>

<script>
export default {
    data() {
        return {
            listKey: 0
        }
    }
}
</script>

<style>

</style>