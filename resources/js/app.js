/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pacientes-component', require('./components/PacientesComponent.vue').default);
Vue.component('datosvisita-component', require('./components/DatosVisitaComponent.vue').default);
Vue.component('agenda-component', require('./components/AgendaComponent.vue').default);
Vue.component('calendario-component', require('./components/CalendarioComponent.vue').default);
Vue.component('modalcalendario-component', require('./components/ModalCalendarioComponent.vue').default);
Vue.component('paciente-component', require('./components/PacienteComponent.vue').default);
Vue.component('visita-component', require('./components/VisitaComponent.vue').default);
Vue.component('visitas-component', require('./components/VisitasComponent.vue').default);
Vue.component('motivosvisita-component', require('./components/MotivosVisitaComponent.vue').default);
Vue.component('tiposvisita-component', require('./components/TiposVisitaComponent.vue').default);
Vue.component('documentos-component', require('./components/DocumentosComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export const bus = new Vue();
const app = new Vue({
    el: '#app',
});
