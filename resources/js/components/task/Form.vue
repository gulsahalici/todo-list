<template>
    <b-container>
        <b-row>
            <b-col>
                <b-form @submit.stop.prevent="submit">
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
import pickBy from 'lodash/pickBy'

export default {
    props: ['task', 'users'],
    data() {
        return {
            form: {},
            selected: null
        }
    },
    methods: {
        submit() {
            if(this.form.id) {
                this.$inertia.put('/tasks/' + this.form.id, pickBy(this.form), { preserveState: true })
                this.$emit('update', 'Task updated.')  
            }
            else {
                this.$inertia.post('/tasks', pickBy(this.form), { preserveState: true })
                this.$emit('update', 'Task created.')  
            }
        }
    },
    mounted() {
        if(this.task) {
            this.form = _.clone(this.task)
        }
    }
}
</script>