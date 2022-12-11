<template> 
    <b-container class="my-2">
        <b-row>
            <b-col class="p-0">
                <b-navbar class="rounded" toggleable="lg" type="dark" variant="info">
                    <b-navbar-brand>
                        To Do
                    </b-navbar-brand>

                    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                    <b-collapse id="nav-collapse" is-nav>
                        <b-navbar-nav>
                            <b-nav-item>
                                <Link class="text-white" style="text-decoration: none;" href="/">
                                    Dashboard
                                </Link>
                            </b-nav-item>
                            <b-nav-item>
                                <Link class="text-white" style="text-decoration: none;" href="/tasks">
                                    Tasks
                                </Link>
                            </b-nav-item>
                        </b-navbar-nav>

                        <b-navbar-nav class="ml-auto">
                            <b-nav-item-dropdown right>
                                <template #button-content>
                                    <em>{{user.name}}</em>
                                </template>
                                <small class="ml-2 mr-2">{{user.email}}</small>
                                <b-dropdown-item href="#" @click="logout">Logout</b-dropdown-item>
                            </b-nav-item-dropdown>
                        </b-navbar-nav>
                    </b-collapse>
                </b-navbar>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    components: {
        Link
    },
    props: ['user'],
    data() {
        return {
            form: this.$inertia.form({})   
        }
    },
    methods: {
        logout() {
            this.form.post('/logout')
        }
    }

}
</script>

<style>

</style>
