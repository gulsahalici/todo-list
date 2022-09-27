<template>
  <b-container>
    <b-row>
        <b-col cols="6" offset="3" class="border p-5 rounded">
            <b-row v-for="task in tasks" :key="task.id" class="py-3 border-bottom">
                <b-col>
                    <b-form-checkbox :id="'task_' + task.id" v-model="task.done" :value="1" :unchecked-value="0" @change="changeTaskStatus(), editingTask = task">
                        <del v-if="task.done" class="text-secondary">
                            {{task.description}}
                        </del>
                        <span v-else>
                            {{task.description}}
                        </span>
                    </b-form-checkbox>
                </b-col>
                <b-col>
                    <b-avatar :size="24"></b-avatar>
                    <b-badge>{{task.user.name}}</b-badge>
                </b-col>
                <hr>
                <b-col cols="2">
                    <b-icon icon="pencil-square" variant="success" class="cursor" @click="editTask(task)"></b-icon>
                    <b-icon icon="trash-fill" variant="danger" class="cursor" v-b-modal="'confirm-modal'" @click="editingTask = task"></b-icon>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
    <b-modal id="confirm-modal" ref="confirm-modal" hide-footer>
        Are you sure want to remove this task?
        <br>
        <small>- {{editingTask.description}} </small>
        <br>
        <b-button class="float-right" variant="outline-success" @click="removeTask">Okkey</b-button>
        <b-button class="float-right mr-2" variant="outline-danger" @click="hideModal">Cancel</b-button>
    </b-modal>
  </b-container>
</template>

<script>
import { fetchTasks, deleteTask, updateTask } from '../../task'

export default {
    data() {
        return{
            tasks: [],
            doneTasks: [],
            editingTask: {}
        }
    },
    methods: {
        editTask(task) {
            this.$emit('editTask', task)
        },
        hideModal() {
            this.$refs['confirm-modal'].hide()
            this.editingTask = {}
        },
        removeTask() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                deleteTask(this.editingTask).then((resp) => {
                    this.tasks.splice(this.tasks.indexOf(this.editingTask), 1)
                    this.editingTask = {}
                    this.hideModal()
                })
            })
        },
        changeTaskStatus(val) {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                updateTask(this.editingTask).then((resp) => {
                    console.log(resp)
                })
            })
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
        })
    }
}
</script>

<style>
.cursor {
    cursor: pointer
}
</style>