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
export default {
    props: ['user'],
    data() {
        return {
            form: this.$inertia.form({})   
        }
    },
    methods: {
        async logout() {
            this.form.post('/logout')
        }
    }

}
</script>

<style>

</style>
