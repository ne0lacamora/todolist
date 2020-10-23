<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    {{ mitarea.nombre }}
                </div>
            </div>
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

        // mounted() {
        //     console.log('Componente Lista de Tareas montado.')
        // },

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

                axios.put(`/tareas/${this.mitarea.id}`, params).then((response) => {
                    // Finalizamos el modo de edición
                    this.editMode = false;
                    const tarea = response.data;
                    // Emitimos el evento update (actualizar) -> Pasamos la informacion editada (campo)
                    this.$emit('update', tarea);
                });
            },
            // Al hacer click eliminar el objecto creado
            onClickDelete() {
                axios.delete(`/tareas/${this.mitarea.id}`).then(() => {
                    this.$emit('delete');
                });
            },
        }
    }
</script>
