<template>
  <b-container>
    <b-card class="mt-3" header="Login">
        <b-form @submit.stop.prevent="login">
            <b-form-group id="email-group" label="Email" label-for="email">
                <b-form-input id="email" v-model="form.email" type="email" placeholder="Enter email" required></b-form-input>
            </b-form-group>

            <b-form-group id="password-group" label="Password" label-for="password">
                <b-form-input id="password" type="password" v-model="form.password"  required></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Login</b-button>
        </b-form>
    </b-card>
  </b-container>
</template>

<script>
import { loginUser } from '../../auth'

export default {
    data() {
        return {
            form: {}
        }
    },
    methods: {
        async login() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                loginUser(this.form).then((resp) => {
                    window.location = '/'
                })
                .catch((error) => {
                    console.log(error)
                })
            });
            // await loginUser(this.form).then((response) => {
            //     window.location = '/'
            // })
            // .catch((error) => {
            //     console.log(error)
            // })
        }
    }

}
</script>

<style>

</style>