require('./bootstrap');

window.Vue = require('vue');

//for vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//import routes
import {routes} from './routes';

//vue-meta
import VueMeta from 'vue-meta'
Vue.use(VueMeta)

Vue.component('admin-router', require('./components/admin/Adminmaster.vue').default);

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode:'history',

})


const app = new Vue({
    el: '#app',
    router
});
