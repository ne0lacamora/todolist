<template>
<!-- Single Tarea -->
<div class="col-sm-12 col-md-6 col-lg-4 mt-3">
    <div class="card" v-bind:class="{ 'bg-success border-success': isActive, 'bg-warning border-warning': isPending, 'bg-danger border-danger': isInactive  }">
        <div class="card-header border-0" v-bind:class="{ 'bg-success': isActive, 'bg-warning': isPending, 'bg-danger': isInactive  }">
            <h4 class="text-white mb-0">{{ mysingle.nombre }}</h4>
        </div>
        <div class="bg-white card-body">
            <!-- ID (Usuario) -->
            <p class="font-weight-light">Usuario: <span class="font-weight-bold">{{ mysingle.name }}</span></p>
            <hr>
            <!-- ID (número de la tarea) -->
            <p class="font-weight-light">Taréa Número: <span class="font-weight-bold">{{ mysingle.id }}</span></p>
            <!-- Nombre de la tarea -->
            <input type="text" class="form-control" v-if="editMode" v-model="mysingle.nombre">
            <p class="font-weight-bold" v-else><span class="font-weight-light">Titulo: </span>{{ mysingle.nombre }}</p>
            <!-- Descripcion -->
            <div class="mb-3" v-if="editMode">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="mitarea_descripcion" id="descripcion" rows="5" v-model="mysingle.descripcion"></textarea>
            </div>
            <p class="rounded-sm" v-else>{{ mysingle.descripcion }}</p>
            <!-- Estados -->
            <p class="mt-1 font-weight-bold">Estado de la Tarea</p>
            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_activa" name="mysingle_estado" class="custom-control-input" value="activa" v-model="mysingle.estado">
                <label class="custom-control-label" for="tarea_activa">Activa</label>
            </div>
            <p class="text-success text-uppercase font-weight-bold" v-else-if="mysingle.estado === 'activa'">{{ mysingle.estado }}</p>

            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_pendiente" name="mysingle_estado" class="custom-control-input" value="pendiente" v-model="mysingle.estado">
                <label class="custom-control-label" for="tarea_pendiente">Pendiente</label>
            </div>
            <p class="text-warning text-uppercase font-weight-bold" v-else-if="mysingle.estado === 'pendiente'">{{ mysingle.estado }}</p>

            <div class="custom-control custom-radio custom-control-inline" v-if="editMode">
                <input type="radio" id="tarea_inactiva" name="mysingle_estado" class="custom-control-input" value="inactiva" v-model="mysingle.estado">
                <label class="custom-control-label" for="tarea_inactiva">Inactiva</label>
            </div>
            <p class="text-danger text-uppercase font-weight-bold" v-else-if="mysingle.estado === 'inactiva'">{{ mysingle.estado }}</p>
            <!-- Fecha de creación y actualización-->
            <p class="font-weight-bold mt-3">Tarea creada el<br><small class="badge badge-pill badge-secondary">{{ moment(mysingle.created_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
            <p class="font-weight-bold">Ultima vez modificada<br><small class="badge badge-pill badge-secondary">{{ moment(mysingle.updated_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
        </div>
        <div class="card-footer border-0" v-bind:class="{ 'bg-success': isActive, 'bg-warning': isPending, 'bg-danger': isInactive  }">
            <!-- Acciones -->
            <div class="" v-if="editMode">
                <button class="mr-1 btn btn-warning" v-bind:class="{'btn-light': isPending}" v-on:click.prevent="onClickUpdate()">Guardar Cambios</button>
                <button class="mr-1 btn btn-secondary" v-on:click.prevent="onClickCancel()">Cancelar</button>
            </div>
            <div v-else>
                <button class="mr-1 btn btn-warning" v-bind:class="{ 'btn-light': isPending, 'btn-warning': isInactive  }" v-on:click.prevent="onClickEdit()">Editar</button>
                <button class="ml-1 btn btn-danger" v-bind:class="{ 'btn-danger': isPending, 'btn-outline-light': isInactive  }" v-on:click.prevent="onClickDelete()">Eliminar</button>
            </div>
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
            editMode: false,
            // Clases de la tarjeta basada en el estado de la tarea.
            isActive: this.mysingle.estado === 'activa',
            isPending: this.mysingle.estado === 'pendiente',
            isInactive: this.mysingle.estado === 'inactiva',
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
                descripcion: this.mysingle.descripcion,
                estado: this.mysingle.estado
            };

            axios.put(`/tarea/${this.mysingle.id}`, params).then((response) => {
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
            axios.delete(`/tarea/${this.mysingle.id}`).then(() => {
                this.$emit('delete');
            });
        },
    }
}
</script>
