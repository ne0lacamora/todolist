<template>
    <div class="row">
        <user-single-component v-for="userSingle in listaTareas" :key="userSingle.id" :userSingle="userSingle">
        </user-single-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                listaTareas: []
            };
        },

        mounted() {
            axios.get("https://jsonplaceholder.typicode.com/todos/").then((response) => {
                this.listaTareas = response.data;
            });
        }
    }
</script>
