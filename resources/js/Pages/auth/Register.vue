<template>
  <b-container>
    <b-row class="mt-5">
        <b-col>
            <h3 class="text-center text-primary">To Do App</h3>
        </b-col>
    </b-row>
    <b-row class="mt-3">
        <b-col cols="6" offset="3">
            <b-alert v-if="Object.keys(errors).length" show variant="danger">
                <p v-for="err in errors">
                    {{err}}
                </p>
            </b-alert>
            <b-card class="mt-3" header="Register">
                <b-form @submit.stop.prevent="register">
                    <b-form-group id="name-group" label="Name" label-for="name">
                        <b-form-input id="name" v-model="form.name" placeholder="Enter name" required></b-form-input>
                    </b-form-group>

                    <b-form-group id="email-group" label="Email" label-for="email">
                        <b-form-input id="email" v-model="form.email" type="email" placeholder="Enter email" required></b-form-input>
                    </b-form-group>

                    <b-form-group id="password-group" label="Password" label-for="password">
                        <b-form-input id="password" type="password" v-model="form.password"  required></b-form-input>
                    </b-form-group>

                    <b-button type="submit" variant="primary" block>Register</b-button>
                </b-form>
            </b-card>
        </b-col>
    </b-row>
    <b-row class="mt-1">
        <b-col cols="6" offset="3">
            <b-card class="text-center">
                Have an account? <Link href="/login">Login</Link>
            </b-card>
        </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
export default {
    props: ['message', 'errors'],
    components: {
        Link
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                password: null
            })     
        }
    },
    methods: {
        async register() {
            this.form.post('/register')
        }
    }
}
</script>