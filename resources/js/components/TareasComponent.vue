<template>
    <div class="container">
        <div class="row" v-for="tareas in groupedTareas">
            <div class="col-md-3 col-sm-6" v-for="tarea in tareas">
                <index class="animated fadeIn" :tarea="tarea"></index>
            </div>
            <div class="col w-100"></div>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import tarea from '../components/IndexComponent'

    export default {
        name: "TareasComponent",
        components: {
            tarea
        },
        mounted() {
            this.$store.dispatch("GET_TAREAS")
            // Listen events
            window.Echo.channel("search").listen(".searchResults", (e) => {
                this.$store.commit("SET_TAREAS", e.tareas)

                console.log(e);
            })
        },
        computed: {
            groupedTareas() {
                return _.chunk(this.tareas, 4);
            },
            // Access tareas state
            ...mapGetters([
                "tareas"
            ])
        }
    }
</script>
