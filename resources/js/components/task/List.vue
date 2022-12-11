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
                <b-form-select v-model="filter.status" :options="status"></b-form-select>
            </b-form-group>
        </b-col>
        <b-col>
            <b-icon icon="search" class="cursor mr-3 mt-2" @click="goPage(1)"></b-icon>
            <b-icon icon="trash-fill" variant="danger" class="cursor" @click="filter = {}, goPage(1)"></b-icon>
        </b-col>
    </b-row>
    <b-row>
        <b-col class="border p-5 rounded" v-if="tasks && tasks.length > 0">
            <b-row v-for="task in tasks" :key="task.id" class="py-3 border-bottom">
                <b-col>
                    <b-form-checkbox :id="'task_' + task.id" v-model="task.status" :value="1" :unchecked-value="0" @change="changeTaskStatus(), editingTask = task">
                        <del v-if="task.status" class="text-secondary">
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
    <b-modal id="confirm-modal" ref="confirm-modal" title="Remove Task" hide-footer>
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
import { deleteTask, updateTask } from '../../task'
import pickBy from 'lodash/pickBy'

export default {
    props: ['updated', 'users', 'tasks', 'pagination'],
    data() {
        return {
            editingTask: {},
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
            this.$inertia.delete('/tasks/'+this.editingTask.id, { preserveState: true })

            this.editingTask = {}
            this.hideModal()

            this.$toast.success('Task deleted', {
                timeout: 5000
            })
        },
        changeTaskStatus(val) {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                updateTask(this.editingTask)
                    .then((resp) => {
                        this.$toast.success(resp.data.message, {
                            timeout: 5000
                        })
                    })
                    .catch((err) => {
                        this.$toast.error(err.response.data.message, {
                            timeout: 5000
                        })
                    })
            })
        },
        goPage(page) {
            const params = {
                page: page,
                filter: this.filter
            }

            this.$inertia.get('/tasks', pickBy(params), { preserveState: true })
        }
    }
}
</script>

<style>
.cursor {
    cursor: pointer
}
</style>