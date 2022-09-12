<template>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody >
                <tr v-for="(user, index) in users.data" :key="index">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                </tr>
            </tbody>
            <!-- <tbody v-else>
                <tr>
                    <td align="center" colspan="3">No record found.</td>
                </tr>
            </tbody> -->
        </table>
        <RenderlessLaravelVuePagination :data="users" @pagination-change-page="getResults" />
    </div>
</template>
<script>
// import console from 'console';

import RenderlessLaravelVuePagination from "./LaravelVuePagination.vue";
export default {

    name: 'edit-com',
    components: {
        pagination: 'RenderlessLaravelVuePagination'
    },
    data() {
        return {
            // Our data object that holds the Laravel paginator data
            users: [],
        }
    },

    mounted() {
        // Fetch initial results
        this.getResults();
    },

    methods: {
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get('http://127.0.0.1:8000/api/getuser?page=' + page)
                .then(response => {
                    // console.log(response.data[0].data)
                    this.users = response.data;
                });
        }
    }

}
</script>
