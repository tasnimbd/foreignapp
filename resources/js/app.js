require('./bootstrap');

window.Vue = require('vue');

//for vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//import routes
import {routes} from './routes';

//support moment js
import {filter} from './filters'

//vue-meta
import VueMeta from 'vue-meta'
Vue.use(VueMeta)

//pagination
Vue.component('pagination', require('laravel-vue-pagination'));

// V-form
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

//VueProgressBar
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'green',
  height: '10px'
})

// Sweet alert 2
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    
  })

window.Toast = Toast

//view-design
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import common from './common'
import jsonToHtml from './jsonToHtml'
Vue.mixin(common)
Vue.mixin(jsonToHtml)

//Editor
import Editor from 'vue-editor-js'
Vue.use(Editor)

//VueShareSocial
import VueShareSocial from 'vue-share-social'
Vue.use(VueShareSocial)

// Support vuex
import Vuex from 'vuex'
Vue.use(Vuex)

import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)


Vue.component('admin-router', require('./components/admin/Adminmaster.vue').default);
Vue.component('frontend-router', require('./components/frontend/Frontendmaster.vue').default);

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
    

})

//require for Fire.$emit
window.Fire = new Vue()

const app = new Vue({
    el: '#app',
    router,
    store,
    data:{
        search: ''
    },
    methods:{
        searchit: _.debounce(() =>{
            Fire.$emit('searching')
        },1000)
    }
});
