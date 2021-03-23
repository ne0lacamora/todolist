<template>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ tarea.nombre }}</h5>
            <!-- <img class="card-img-top" :src="tarea.image" :alt="tarea.name"> -->
        </div>
        <div class="card-body">
            <p class="card-text">{{ tarea.descripcion }}</p>
        </div>
        <div class="card-footer">
            <span class="text-success font-weight-bold text-uppercase" v-if="tarea.estado === 'activa'"><span class="text-dark font-weight-normal">Estado:</span> {{ tarea.estado }}</span>
            <span class="text-warning font-weight-bold text-uppercase" v-else-if="tarea.estado === 'pendiente'"><span class="text-dark font-weight-normal">Estado:</span> {{ tarea.estado }}</span>
            <span class="text-danger font-weight-bold text-uppercase" v-else><span class="text-dark font-weight-normal">Estado:</span> {{ tarea.estado }}</span>
        </div>
    </div>
</template>
<script>
    export default {
        name: "IndexComponent",
        props: ['tarea']
    }
</script>
