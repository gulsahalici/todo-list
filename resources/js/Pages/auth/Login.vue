<template>
  <b-container>
    <b-row class="mt-5">
        <b-col>
            <h3 class="text-center text-primary">To Do App</h3>
        </b-col>
    </b-row>
    <b-row class="mt-3">
        <b-col cols="6" offset="3">
            <b-alert v-if="message" show variant="danger">{{message}}</b-alert>
            <b-card class="mt-3" header="Login">
                <b-form @submit.stop.prevent="login">
                    <b-form-group id="email-group" label="Email" label-for="email">
                        <b-form-input id="email" v-model="form.email" type="email" placeholder="Enter email" required></b-form-input>
                    </b-form-group>

                    <b-form-group id="password-group" label="Password" label-for="password">
                        <b-form-input id="password" type="password" v-model="form.password"  required></b-form-input>
                    </b-form-group>
                    
                    <b-button type="submit" variant="primary" block>Login</b-button>
                </b-form>
            </b-card>
        </b-col>
    </b-row>
    <b-row class="mt-1">
        <b-col cols="6" offset="3">
            <b-card class="text-center">
              Don't have an account? <Link href="/register">Register</Link>
            </b-card>
        </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
export default {
    props: ['message'],
    components: {
        Link
    },
    data() {
        return {
            form: this.$inertia.form({
                email: null,
                password: null
            })         
        }
    },
    methods: {
        login() {
            this.form.post('/login')
        }
    }
}
</script>