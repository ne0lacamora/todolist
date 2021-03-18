<template>
    <div class="mt-3 card border-success">
        <div class="card-header bg-success">
            <h4 class="text-white mb-0">{{ mitarea.nombre }}</h4>
        </div>
        <div class="bg-white card-body">
            <!-- ID (número de la tarea) -->
            <p class="font-weight-light">Taréa Número: <span class="font-weight-bold">{{ mitarea.id  }}</span></p>
            <hr>
            <!-- Nombre de la tarea -->
            <input type="text" class="form-control" v-if="editMode" v-model="mitarea.nombre">
            <p class="font-weight-bold" v-else>{{ mitarea.nombre }}</p>
            <div class="clearfix">
                <hr>
            </div>
            <!-- Estados -->
            <p class="mt-1 font-weight-bold">Estado de la Tarea</p>
            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_activa" name="mitarea_estado" class="custom-control-input" value="activa" v-model="mitarea.estado">
                <label class="custom-control-label" for="tarea_activa">Activa</label>
            </div>
            <p class="text-success text-uppercase font-weight-bold" v-else-if="mitarea.estado === 'activa'">{{ mitarea.estado }}</p>

            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_pendiente" name="mitarea_estado" class="custom-control-input" value="pendiente" v-model="mitarea.estado">
                <label class="custom-control-label" for="tarea_pendiente">Pendiente</label>
            </div>
            <p class="text-warning text-uppercase font-weight-bold" v-else-if="mitarea.estado === 'pendiente'">{{ mitarea.estado }}</p>

            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_inactiva" name="mitarea_estado" class="custom-control-input" value="inactiva" v-model="mitarea.estado">
                <label class="custom-control-label" for="tarea_inactiva">Inactiva</label>
            </div>
            <p class="text-danger text-uppercase font-weight-bold" v-else-if="mitarea.estado === 'inactiva'">{{ mitarea.estado }}</p>

            <!-- Fecha de creación y actualización -->
            <p class="font-weight-bold mt-3">Tarea creada el<br><small class="badge badge-pill badge-secondary">{{ moment(mitarea.created_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
            <p class="font-weight-bold">Última vez modificada<br><small class="badge badge-pill badge-secondary">{{ moment(mitarea.updated_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
        </div>
        <div class="card-footer bg-success">
            <!-- Acciones -->
            <button v-if="editMode" class="mr-1 btn btn-warning" v-on:click.prevent="onClickUpdate()">Guardar Cambios</button>
            <button v-else class="mr-1 btn btn-warning" v-on:click.prevent="onClickEdit()">Editar</button>
            <button class="ml-1 btn btn-danger" v-on:click.prevent="onClickDelete()">Eliminar</button>
        </div>
    </div>
</template>
<script>
    // Moment Js (Date Formatting)
    import moment from 'moment';

    export default {
        props: ['mitarea'],

        data() {
            return {
                // Retornar el formato de fecha de moment
                moment: moment,
                // Determinar si el componente se esta editando o no
                editMode: false
            };
        },

        methods: {
            // Al hacer click editar el objecto creado
            onClickEdit() {
                this.editMode = true;
            },
            // Actualizar el componente al ser guardado
            onClickUpdate() {
                const params = {
                    nombre: this.mitarea.nombre,
                    estado: this.mitarea.estado
                };

                axios.put(`/crear/${this.mitarea.id}`, params).then((response) => {
                    // Finalizamos el modo de edición
                    this.editMode = false;
                    // Data
                    const tarea = response.data;
                    // Emitimos el evento update (actualizar) -> Pasamos la informacion editada (campo)
                    this.$emit('update', tarea);
                });
            },
            // Al hacer click eliminar el objecto creado
            onClickDelete() {
                axios.delete(`/crear/${this.mitarea.id}`).then(() => {
                    this.$emit('delete');
                });
            },
        }
    }
</script>
