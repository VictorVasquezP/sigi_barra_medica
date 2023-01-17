require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import { createPinia, PiniaVuePlugin } from 'pinia'

Vue.use(PiniaVuePlugin)
const pinia = createPinia()
Vue.use(require('vue-moment'));

/**
 * Registro de componentes
 */
// Vue.component('dashboard-view', require('./views/Dashboard.vue').default);
Vue.component('command-view', require('./views/Command.vue').default);

const app = new Vue({
    el: '#app',
    pinia
});