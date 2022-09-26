<template>
    <b-container>
        <b-row>
            <b-col cols="6" offset="3" class="border p-5 rounded">
                <b-form @submit.stop.prevent="createTask">
                    <b-form-group id="description" label="Description" label-for="description">
                        <b-form-input id="description" v-model="form.description" placeholder="Enter description" required></b-form-input>
                    </b-form-group>

                    <b-form-group id="user" label="User" label-for="user">
                        <b-form-select v-model="form.user_id" :options="users" required></b-form-select>
                    </b-form-group>

                    <b-button type="submit" variant="primary"  block><b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon>New Task</b-button>
                </b-form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import { fetchUsers } from '../../user'
import { storeTask } from '../../task'

export default {
    data() {
        return {
            form: {

            },
            selected: null,
            users: []
        }
    },
    methods: {
        createTask() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                storeTask(this.form).then((resp) => {
                    this.$emit('updated')   
                })
                .catch((error) => {
                    console.log(error)
                })
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
        });
}

}
</script>

<style>

</style>