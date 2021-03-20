<template>
    <div class="mt-3 card" v-bind:class="{ 'bg-success border-success': isActive, 'bg-warning border-warning': isPending, 'bg-danger border-danger': isInactive  }">
        <div class="card-header" v-bind:class="{ 'bg-success': isActive, 'bg-warning': isPending, 'bg-danger': isInactive  }">
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
            <div class="mb-3" v-if="editMode">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="mitarea_descripcion" id="descripcion" rows="5" v-model="mitarea.descripcion"></textarea>
            </div>
            <p class="bg-warning py-1 px-2 rounded-sm" v-else>{{ mitarea.descripcion }}</p>
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
        <div class="card-footer" v-bind:class="{ 'bg-success': isActive, 'bg-warning': isPending, 'bg-danger': isInactive  }">
            <!-- Acciones -->
            <button v-if="editMode" class="mr-1 btn btn-warning" v-bind:class="{'btn-light': isPending}" v-on:click.prevent="onClickUpdate()">Guardar Cambios</button>
            <button v-else class="mr-1 btn btn-warning" v-bind:class="{ 'btn-light': isPending, 'btn-warning': isInactive  }" v-on:click.prevent="onClickEdit()">Editar</button>
            <button class="ml-1 btn btn-danger" v-bind:class="{ 'btn-danger': isPending, 'btn-outline-light': isInactive  }" v-on:click.prevent="onClickDelete()">Eliminar</button>
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
                editMode: false,

                // Clases de la tarjeta basada en el estado de la tarea.
                isActive: this.mitarea.estado === 'activa',
                isPending: this.mitarea.estado === 'pendiente',
                isInactive: this.mitarea.estado === 'inactiva',
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
                    descripcion: this.mitarea.descripcion,
                    estado: this.mitarea.estado
                };

                axios.put(`/tarea/${this.mitarea.id}`, params).then((response) => {
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
                axios.delete(`/tarea/${this.mitarea.id}`).then(() => {
                    this.$emit('delete');
                });
            },
        }
    }
</script>
