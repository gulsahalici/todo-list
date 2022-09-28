<template>
  <b-container>
    <b-row class="border pt-3 rounded">
        <b-col cols="6">
            <b-form-input v-model="filter.description" id="description" placeholder="Description"></b-form-input>
        </b-col>
        <b-col cols="3">
            <b-form-group id="user">
                <b-form-select v-model="filter.user_id" :options="users"></b-form-select>
            </b-form-group>
        </b-col>
        <b-col cols="2">
            <b-form-group id="status">
                <b-form-select v-model="filter.done" :options="status"></b-form-select>
            </b-form-group>
        </b-col>
        <b-col>
            <b-icon icon="search" class="cursor mr-3 mt-2" @click="filterTasks"></b-icon>
            <b-icon icon="trash-fill" variant="danger" class="cursor" @click="filter = {}, goPage(1)"></b-icon>
        </b-col>
    </b-row>
    <b-row>
        <b-col class="border p-5 rounded" v-if="tasks && tasks.length > 0">
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
                <b-col cols="2">
                    <b-avatar :size="24"></b-avatar>
                    <b-badge>{{task.user.name}}</b-badge>
                </b-col>
                <hr>
                <b-col cols="2">
                    <b-icon icon="pencil-square" variant="success" class="cursor" @click="editTask(task)"></b-icon>
                    <b-icon icon="trash-fill" variant="danger" class="cursor" v-b-modal="'confirm-modal'" @click="editingTask = task"></b-icon>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-pagination
                        v-model="pagination.current_page"
                        :total-rows="pagination.total"
                        :per-page="pagination.per_page"
                        first-text="⏮"
                        prev-text="⏪"
                        next-text="⏩"
                        last-text="⏭"
                        class="mt-4"
                        align="center"
                        @change="goPage"
                    ></b-pagination>
                </b-col>
            </b-row>
        </b-col>
        <b-col class="border p-5 rounded" v-else>
            <b-alert show>
                There is no task.
            </b-alert>
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
    props: ['updated', 'users'],
    data() {
        return{
            tasks: [],
            editingTask: {},
            pagination: {},
            status: [
                {
                    text: 'Done',
                    value: 1
                },
                {
                    text: 'Not done',
                    value: 0
                }
            ],
            filter: {}
        }
    },
    watch: {
        updated(val) {
            this.goPage(this.pagination.current_page)
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
                    this.editingTask = {}
                    this.hideModal()
                    this.goPage(this.pagination.current_page)
                })
            })
        },
        changeTaskStatus(val) {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                updateTask(this.editingTask).then((resp) => {
                    console.log(resp)
                })
            })
        },
        goPage(page) {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                fetchTasks({page}).then((resp) => {
                    this.tasks = resp?.data?.tasks
                    this.pagination = resp?.data?.pagination
                })
            })
        },
        filterTasks() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                fetchTasks({
                    page: this.pagination.current_page,
                    filter: this.filter
                }).then((resp) => {
                    this.tasks = resp?.data?.tasks
                    this.pagination = resp?.data?.pagination
                })
            })
        }
    },
    mounted() {
        this.goPage(1)
    }
}
</script>

<style>
.cursor {
    cursor: pointer
}
</style>