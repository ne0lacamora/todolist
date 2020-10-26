<template>
    <div class="mt-3 card border-success">
        <div class="card-header bg-success">
            <h4 class="text-white">{{ mitarea.nombre }}</h4>
        </div>
        <div class="bg-white card-body">
            <!-- ID (número de la tarea) -->
            <p class="font-weight-light">Taréa Número: <span class="font-weight-bold">{{ mitarea.id  }}</span></p>
            <hr>
            <!-- Nombre de la tarea -->
            <input type="text" class="form-control" v-if="editMode" v-model="mitarea.nombre">
            <p class="font-weight-bold" v-else>{{ mitarea.nombre }}</p>
            <!-- Descripción -->
            <textarea v-if="editMode" cols="30" rows="5" class="mt-2 form-control" v-model="mitarea.descripcion"></textarea>
            <p v-else class="font-weight-light">{{ mitarea.descripcion }}</p>
            <div class="clearfix">
                <hr>
            </div>
            <!-- Estados -->
            <p class="mt-1 font-weight-bold">Estado de la Tarea</p>
            <p class="text-success text-uppercase font-weight-bold" v-if="mitarea.estado === 'activa'">{{ mitarea.estado }}</p>
            <p class="text-warning text-uppercase font-weight-bold" v-else-if="mitarea.estado === 'pendiente'">{{ mitarea.estado }}</p>
            <p class="text-danger text-uppercase font-weight-bold" v-else>{{ mitarea.estado }}</p>
            <!-- Fecha de creación y actualización-->
            <p class="font-weight-bold">Tarea creada el<br><small class="badge badge-pill badge-secondary">{{ moment(mitarea.created_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
            <p class="font-weight-bold">Ultima vez modificada<br><small class="badge badge-pill badge-secondary">{{ moment(mitarea.updated_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
        </div>
        <div class="card-footer bg-success">
            <!-- Acciones -->
            <button v-if="editMode" class="mr-1 btn btn-success" v-on:click.prevent="onClickUpdate()">Guardar Cambios</button>
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
                    descripcion: this.mitarea.descripcion,
                    estado: this.mitarea.estado
                };

                axios.put(`/crear/${this.mitarea.id}`, params).then((response) => {
                    // Finalizamos el modo de edición
                    this.editMode = false;
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
