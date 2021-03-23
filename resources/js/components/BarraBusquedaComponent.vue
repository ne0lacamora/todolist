<template>
    <div class="container">
        <!-- <form action="#" method="GET"> -->
            <!-- @csrf -->
            <div class="input-group">
                <input v-model="query" type="text" name="busqueda" id="" class="form-control rounded-0 border-right-0" aria-label="Buscar tareas..." placeholder="Buscar tareas...">
                <button type="button" class="input-group-text border-left-0 rounded-0 bg-white" v-on:click="searchTareas" @keyup.enter="searchTareas"><span class="sr-only">Buscar</span> <i class="icofont-search"></i></button>
            </div>
        <!-- </form> -->
    </div>
</template>
<script>
export default {
    name: "BarraBusquedaComponent",
    data() {
        return {
            query: "",
        }
    },
    watch: {
        query: {
            handler: _.debounce(function () {
                this.searchTareas()
            }, 100)
        }
    },
    methods: {
        searchTareas() {
            this.$store.dispatch('SEARCH_TAREAS', this.query)
        }
    }
}
</script>
