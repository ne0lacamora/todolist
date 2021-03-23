/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store/index';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('lista-recientes-component', require('./components/ListaRecientesComponent.vue').default);
Vue.component('crear-component', require('./components/CrearComponent.vue').default);
Vue.component('recientes-component', require('./components/RecientesComponent.vue').default);
Vue.component('lista-usuarios-component', require('./components/ListaUsuariosComponent.vue').default);
Vue.component('usuario-component', require('./components/UsuarioComponent.vue').default);
Vue.component('barra-busqueda-component', require('./components/BarraBusquedaComponent.vue').default);
Vue.component('index', require('./components/IndexComponent.vue').default);
Vue.component('tareas', require('./components/TareasComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
