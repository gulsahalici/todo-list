<template> 
    <b-container class="my-2">
        <div class="float-right mb-2 text-right">
            <small v-if="user">
                <b>{{user.name}}</b> 
                <p class="my-0">{{user.email}}</p>
                <p class="my-0">
                    <b-button class="py-0 pr-0" @click="logout" variant="link">
                        Logout
                    </b-button>
                </p> 
                <hr class="my-0">
            </small>
        </div>
        <div class="clearfix"></div>
    </b-container>
</template>

<script>
import { logoutUser } from '../../auth'

export default {
    props: ['user'],
    methods: {
        async logout() {
            axios.get('/sanctum/csrf-cookie').then(response => { 
                logoutUser()
                    .then((resp) => {
                        window.location = '/'
                    })
                    .catch((err) => {
                        this.$toast.error(err.response.data.message, {
                            timeout: 5000
                        })
                    })
            })
        }
    }

}
</script>

<style>

</style>
