<template>
  <b-container class="text-center">
    <h4>Task List</h4>
    <b-row>
        <b-col cols="6" offset="3" class="border p-5 rounded">
            <b-form-checkbox-group v-model="doneTasks">
                <b-row v-for="task in tasks" :key="task.id">
                    <b-form-checkbox :id="'task_' + task.id" :value="task.id" :checked-value="1" :unchecked-value="0">
                        <del v-if="doneTasks.includes(task.id)" class="text-secondary">
                            {{task.description}}
                        </del>
                        <span v-else>
                            {{task.description}}
                        </span>
                    </b-form-checkbox>
                </b-row>
            </b-form-checkbox-group>
        </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { fetchTasks } from '../../task'

export default {
data() {
    return{
        tasks: [],
        doneTasks: []
    }
},
mounted() {
      axios.get('/sanctum/csrf-cookie').then(response => { 
            fetchTasks().then((resp) => {
                this.tasks = resp?.data?.map((task) => {
                    if(task.done == 1) {
                        this.doneTasks.push(task.id)
                    }

                    return task
                })
            })
            .catch((error) => {
                console.log(error)
            })
        });
}
}
</script>

<style>

</style>