<template>
    <div class="col-sm-4 mt-3">
        <div class="card border-success">
            <div class="card-header bg-success">
                <h4 class="text-white">{{ userSingle.title }}</h4>
            </div>
            <div class="bg-white card-body">
                <!-- ID (Usuario) -->
                <p class="font-weight-light">ID Usuario: <span class="font-weight-bold">{{ userSingle.userId  }}</span></p>
                <hr>
                <!-- ID (número de la tarea) -->
                <p class="font-weight-light">Taréa Número: <span class="font-weight-bold">{{ userSingle.id  }}</span></p>
                <hr>
                <!-- Nombre de la tarea -->
                <p class="font-weight-bold">{{ userSingle.title }}</p>
                <!-- Estados -->
                <p class="mt-1 font-weight-bold">Estado de la Tarea</p>
                <p class="text-success text-uppercase font-weight-bold" v-if="userSingle.completed === true">Realizada</p>
                <p class="text-danger text-uppercase font-weight-bold" v-else>No Realizada</p>
                <!-- Fecha de creación y actualización-->
                <p class="font-weight-bold">Tarea creada el<br><small class="badge badge-pill badge-secondary">{{ moment(userSingle.created_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
                <p class="font-weight-bold">Ultima vez modificada<br><small class="badge badge-pill badge-secondary">{{ moment(userSingle.updated_at).format("ddd DD / MMM / YYYY [a las] LTS") }}</small></p>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: ['userSingle'],

    data() {
        return {
            // Retornar el formato de fecha de moment
            moment: moment,
        };
    }
}
</script>
