<template>
<!-- Single Tarea -->
<div class="col-sm-3 col-md-4 col-lg-4 mt-3">
    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="text-white mb-0">{{ mysingle.nombre }}</h4>
        </div>
        <div class="bg-white card-body">
            <!-- ID (Usuario) -->
            <p class="font-weight-light">ID Usuario: <span class="font-weight-bold">{{ mysingle.user_id  }}</span></p>
            <hr>
            <!-- ID (número de la tarea) -->
            <p class="font-weight-light">Taréa Número: <span class="font-weight-bold">{{ mysingle.id  }}</span></p>
            <!-- Nombre de la tarea -->
            <input type="text" class="form-control" v-if="editMode" v-model="mysingle.nombre">
            <p class="font-weight-bold" v-else><span class="font-weight-light">Titulo:</span> {{ mysingle.nombre }}</p>
            <!-- Estados -->
            <p class="mt-1 font-weight-bold">Estado de la Tarea</p>
            <p class="text-success text-uppercase font-weight-bold" v-if="mysingle.estado === 'activa'">Activa</p>
            <p class="text-warning text-uppercase font-weight-bold" v-else-if="mysingle.estado === 'pendiente'">{{ mysingle.estado }}</p>
            <p class="text-danger text-uppercase font-weight-bold" v-else>Inactiva</p>
            <!-- Fecha de creación y actualización-->
            <p class="font-weight-bold">Tarea creada el<br><small class="badge badge-pill badge-secondary">{{ moment(mysingle.created_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
            <p class="font-weight-bold">Ultima vez modificada<br><small class="badge badge-pill badge-secondary">{{ moment(mysingle.updated_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
        </div>
        <div class="card-footer bg-success">
            <!-- Acciones -->
            <button v-if="editMode" class="mr-1 btn btn-success" v-on:click.prevent="onClickUpdate()">Guardar Cambios</button>
            <button v-else class="mr-1 btn btn-warning" v-on:click.prevent="onClickEdit()">Editar</button>
            <button class="ml-1 btn btn-danger" v-on:click.prevent="onClickDelete()">Eliminar</button>
        </div>
    </div>
</div>
</template>

<script>
// Moment Js (Date Formatting)
import moment from 'moment';

export default {
    props: ['mysingle'],

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
                nombre: this.mysingle.nombre,
                estado: this.mysingle.estado
            };

            axios.put(`/crear/${this.mysingle.id}`, params).then((response) => {
                // Finalizamos el modo de edición
                this.editMode = false;
                // Obtenemos la data de la respuesta
                const single = response.data;
                // Emitimos el evento update (actualizar) -> Pasamos la informacion editada (campo)
                this.$emit('update', single);
            });
        },
        // Al hacer click eliminar el objecto creado
        onClickDelete() {
            axios.delete(`/crear/${this.mysingle.id}`).then(() => {
                this.$emit('delete');
            });
        },
    }
}
</script>
