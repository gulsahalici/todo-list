<template>
    <div>
        <h1>Hello {{name}}</h1>
        <nav>
            <ul>
                <li><Link href="/hello-inertia">Home</Link></li>
                <li><Link href="/settings">Settings</Link></li>
                <li><Link href="/users">Users</Link></li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
props: ['name'],
components: {
    Link
}
}
</script>
