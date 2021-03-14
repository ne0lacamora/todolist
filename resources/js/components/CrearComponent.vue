<template>
    <div class="order-1 order-md-2 col-md-7 offset-md-1 crear-tarea">
        <h3>Crear Nueva Tarea</h3>
        <hr>
        <div class="card sticky-top">
            <div class="card-header">Crear Nueva Tarea</div>
            <div class="card-body">
                <form class="needs-validation" v-on:submit.prevent="newTarea()">
                    <input type="hidden" name="_token" :value="csrf">
                    <!-- Nombre de la tarea -->
                    <div class="form-group">
                        <label for="title">Nombre de la Tarea</label>
                        <input type="text" name="title" class="form-control" placeholder="Ej: Estudiar VueJs" v-model="title" required>
                    </div>
                    <!-- Estado de la tarea -->
                    <div class="form-group">
                        <p>Estado de la tarea</p>
                    </div>
                    <!-- Estado Activa -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="true" name="completed" class="custom-control-input" value="true" v-model="completed" required>
                        <label class="custom-control-label" for="true">Realizada (Completa)</label>
                    </div>
                    <!-- Estado Inactiva -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="false" name="completed" class="custom-control-input"  value="false" v-model="completed" required>
                        <label class="custom-control-label" for="false">No Realizada (No Completa)</label>
                    </div>
                    <div class="mt-3 form-group">
                        <span class="text-capitalize">Estado seleccionado: {{ completed }}</span>
                    </div>
                    <!-- Crear tarea -->
                    <div class="mt-3 form-group">
                        <button type="submit" class="btn btn-success">Crear Tarea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                title: '',
                completed: null
            }
        },

        methods: {
            newTarea() {
                // Parametros (datos) a ser obtenidos
                const params = {
                    title: this.title,
                    completed: this.completed,
                };

                // Vaciamos los campos al enviar los valores
                this.title = '';
                this.completed = null;

                // Metodo post para enviar los datos y entonces generar/obtener una respuesta
                axios.post('https://jsonplaceholder.typicode.com/todos/', params).then((response) => {
                    // Obtenemos el objecto a partir de la respuesta del servidor
                    const tarea = response.data;

                    // Emitir (evento new) de la nueva tarea
                    this.$emit('new', tarea);

                    // Notificación acerca del estado (resultado) de la tarea
                })
                .catch(error => {
                    // Notificación acerca del estado (resultado) de la tarea
                    console.log(error);
                });
            }
        }
    }
</script>
