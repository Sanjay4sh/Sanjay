<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="form-group pr-1">

                                <input type="text" v-model="search" id="name" @keyup="searchUnit" class="form-control" placeholder="search here"
                                    aria-describedby="helpId">
                                <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            </div>
                    <div class="card-header">

                        <form class="form-inline" @submit.prevent="add" id="formid">
                            <div class="form-group pr-1">
                                <label for="">Name : </label>
                                <input type="text" v-model="userdata.name" id="name" class="form-control" placeholder=""
                                    aria-describedby="helpId">
                                <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            </div>

                            <div class="form-group pr-1">
                                <label for="">Email : </label>
                                <input type="text" v-model="userdata.email" id="email" class="form-control"
                                    placeholder="" aria-describedby="helpId">
                                <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            </div>

                            <div class="form-group">
                                <button class="form-control btn btn-primary">Add</button>
                                <input type="reset" value="Reset" class="form-control btn btn-danger"
                                    v-on:click="reset()" />

                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" v-bind:key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td><a class="btn btn-danger" v-on:click="deleteUser(user.id)">Delete</a></td>
                                    <td><a class="btn btn-success" @click.prevent="edit(user.id)">{{ user.id }}</a></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

 import _ from "lodash";
export default {

    name: 'first-com',
    components: {

    },
    props: {
        msg: String
    },

    data() {
        return {
            users: [],
            editing: false,
            userdata: {
                name: '',
                email: '',
                id:'',

            },

                search:''
        };
    },

    methods: {

        async getData() {
            try {
                let response = await fetch("http://127.0.0.1:8000/api/getuser");
                this.users = await response.json();
                // console.log(response)
            } catch (error) {
                // console.log(error);
            }
        },
        searchUnit:_.debounce(function(){
            try {
                axios.get(`http://127.0.0.1:8000/api/search?search=`+this.search);

                // $('').empty();
                this.users =response.data;

            //   console.log(this.response())
            } catch (error) {
                // console.log(error);
            }
        }),

        add(event) {

                axios.post('http://127.0.0.1:8000/api/store', this.userdata)
                    .then((response) => {
                        this.userdata.name = this.userdata.email = '';
                        event.target.reset();
                    })

            this.getData();
        },
        deleteUser(id) {
            axios.delete('http://127.0.0.1:8000/api/delete/' + id).then((response) => {
                alert('record deleted')
            })
            this.getData();

        },

        edit(id, event) {
            axios.get('http://127.0.0.1:8000/api/edit/' + id).then((response) => {

                this.userdata.id = this.userdata.name = this.userdata.email = '';
                this.editing = true;

                $('form #name').val(response.data[0].name)
                $('form #email').val(response.data[0].email)
                $('form #id').val(response.data[0].id)
                console.log(response.data[0].name)
                // this.editing = false;

            })
        },
        reset(event) {

            this.userdata.name = this.userdata.email = '';
            // event.target.reset();

        }
    },
    created() {
        this.getData();
        // this.serachvalue();
    },

}
</script>
