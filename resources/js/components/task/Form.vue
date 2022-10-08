<template>
    <b-container>
        <b-row>
            <b-col>
                <b-form @submit.stop.prevent="createTask">
                    <b-form-group id="description" label="Description" label-for="description">
                        <b-form-textarea id="description" v-model="form.description" placeholder="Enter description" required rows="3" max-rows="10"></b-form-textarea>
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
import { storeTask, updateTask } from '../../task'

export default {
    props: ['task', 'users'],
    data() {
        return {
            form: {},
            selected: null
        }
    },
    methods: {
        createTask() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                if(this.form.id) {
                    updateTask(this.form)
                        .then((resp) => {
                            this.$emit('updated')   
                            this.form = {}
                            
                            this.$toast.success(resp.data.message, {
                                timeout: 5000
                            })
                        })
                        .catch((err) => {
                            this.$toast.error(err.response.data.message, {
                                timeout: 5000
                            })
                        })
                }
                else {
                    storeTask(this.form)
                        .then((resp) => {
                            this.$emit('updated')   
                            this.form = {}

                            this.$toast.success(resp.data.message, {
                                timeout: 5000
                            })
                        })
                        .catch((err) => {
                            this.$toast.error(err.response.data.message, {
                                timeout: 5000
                            })
                        })
                }
            })
        }
    },
    mounted() {
        if(this.task) {
            this.form = JSON.parse(JSON.stringify(this.task)) 
        }
    }
}
</script>

<style>

</style>