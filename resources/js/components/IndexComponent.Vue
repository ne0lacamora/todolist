<template>
    <div class="row">
        <user-single-component
        v-for="userSingle in listaTareas"
        :key="userSingle.id"
        :userSingle="userSingle">
        </user-single-component>
    </div>
</template>

<script>
export default {
    // Creating data function
    data() {
        // Return the objects (results)
        return {
            // Objects to be loaded (array) from the database
            listaTareas: []
        };
    },

    // Mounted function
    mounted() {
        axios.get('/crear').then((response) => {
            this.listaTareas = response.data;
        });
    },

    // Methods
    // methods: {

    // }
}
</script>
