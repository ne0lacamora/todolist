<template>
	<div class="row">
        <div class="mb-4 col-sm-12">
            <h2>Lista de Tareas</h2>
        </div>
        <single-component
        v-for="(single, index) in listaTareas"
        :key="single.id"
        :mysingle="single"
        @update="updateTarea(index, ...arguments)"
        @delete="deleteTarea(index)">
        </single-component>
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
            axios.get('/crear').then((response) => {
                this.listaTareas = response.data;
            });
        },

        // Methods
        methods: {
            addTarea(single) {
                this.listaTareas.push(single);
            },

            updateTarea(index, mysingle) {
                this.listaTareas[index] = mysingle;
            },

            deleteTarea(index) {
                this.listaTareas.splice(index, 1);
            }
        }
    }
</script>
