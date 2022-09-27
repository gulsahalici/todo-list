<template>
    <b-container>
        <b-row>
            <b-col cols="6" offset="3" class="border py-3 px-5 rounded">
                <b-button v-if="form.id" @click="form={}" variant="primary" class="float-right" size="sm">
                    <b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon>New Task
                </b-button>
                <h6 class="text-center" v-if="form.id">Edit Task</h6>
                <h6 class="text-center" v-else>New Task</h6>
                <br>
                <b-form @submit.stop.prevent="createTask">
                    <b-form-group id="description" label="Description" label-for="description">
                        <b-form-input id="description" v-model="form.description" placeholder="Enter description" required></b-form-input>
                    </b-form-group>

                    <b-form-group id="user" label="User" label-for="user">
                        <b-form-select v-model="form.user_id" :options="users" required></b-form-select>
                    </b-form-group>

                    <b-button type="submit" variant="primary"  block>
                        <b-icon icon="save" aria-hidden="true"></b-icon> 
                        <span v-if="form.id">
                            Update Task
                        </span>
                        <span v-else>
                            New Task
                        </span>
                    </b-button>
                </b-form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import { fetchUsers } from '../../user'
import { storeTask, updateTask } from '../../task'

export default {
    props: ['task'],
    data() {
        return {
            form: {},
            selected: null,
            users: []
        }
    },
    methods: {
        createTask() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                if(this.form.id) {
                    updateTask(this.form).then((resp) => {
                        this.$emit('updated')   
                        this.form = {}
                    })
                }
                else {
                    storeTask(this.form).then((resp) => {
                        this.$emit('updated')   
                        this.form = {}
                    })
                }
            })
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
            .catch((error) => {
                console.log(error)
            })
        })

        if(this.task) {
            this.form = this.task
        }
    }
}
</script>

<style>

</style>