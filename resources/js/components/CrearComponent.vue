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
                        <label for="nombre">Nombre de la Tarea</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Estudiar VueJs" v-model="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="5" v-model="descripcion"></textarea>
                    </div>
                    <!-- Estado de la tarea -->
                    <!-- COLOR DE LA APP #7012FD -->
                    <div class="form-group">
                        <p>Estado de la tarea</p>
                    </div>
                    <!-- Estado Activa -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="activa" name="estado" class="custom-control-input" value="activa" v-model="estado" required>
                        <label class="custom-control-label" for="activa">Activa</label>
                    </div>
                    <!-- Estado Pendiente -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="pendiente" name="estado" class="custom-control-input" value="pendiente" v-model="estado" required>
                        <label class="custom-control-label" for="pendiente">Pendiente</label>
                    </div>
                    <!-- Estado Inactiva -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="inactiva" name="estado" class="custom-control-input"  value="inactiva" v-model="estado" required>
                        <label class="custom-control-label" for="inactiva">Inactiva</label>
                    </div>
                    <div class="mt-3 form-group">
                        <span class="text-capitalize">Estado seleccionado: {{ estado }}</span>
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
                nombre: "",
                descripcion: "",
                estado: ""
            }
        },

        methods: {
            newTarea() {
                // Parametros (datos) a ser obtenidos
                const params = {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    estado: this.estado,
                };

                // Vaciamos los campos al enviar los valores
                this.nombre = "";
                this.descripcion = "";
                this.estado = "";

                // Metodo post para enviar los datos y entonces generar/obtener una respuesta
                axios.post("/tarea", params).then((response) => {
                    // Obtenemos el objecto a partir de la respuesta del servidor
                    const tarea = response.data;

                    // Emitir (evento new) de la nueva tarea
                    this.$emit("new", tarea);

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
