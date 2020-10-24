<template>
	<div class="row justify-content-center">
        <!-- Lista de tareas -->
        <div class="order-2 order-md-1 col-md-4 lista-de-tareas">
            <h3>Tareas <small><a href="home">Ver todas</a></small></h3>
            <hr>
            <tarea-component
            v-for="(tarea, index) in listaTareas"
            :key="tarea.id"
            :mitarea="tarea"
            @update="updateTarea(index, ...arguments)"
            @delete="deleteTarea(index)">
            </tarea-component>
        </div>
        <!-- Crear nueva tarea -->
        <crear-component @new="addTarea">
        </crear-component>
    </div>
</template>
<script>
    export default {
        // Crear la Function data()
        data() {
            // Retornar el resultado
            return {
                // Objectos a ser cargados (array) desde la base de datos
                listaTareas: []
            }
        },

        // Function
        mounted() {
            axios.get('/crear-tarea').then((response) => {
                this.listaTareas = response.data;
            });
        },

        // Methods
        methods: {
            addTarea(tarea) {
                this.listaTareas.push(tarea);
            },

            updateTarea(index, mitarea) {
                this.listaTareas[index] = mitarea;
            },

            deleteTarea(index) {
                this.listaTareas.splice(index, 1);
            }
        }
    }
</script>
