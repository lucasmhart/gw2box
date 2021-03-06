/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Route from "@/src/helpers/Route";
import Token from "@/src/helpers/Token";
import Auth from "@/src/helpers/Auth";
import GWObject from "@/src/GW2/Object";

import Swal from 'sweetalert2'

// import 'sweetalert2/src/sweetalert2.scss'
import '@sweetalert2/themes/dark/dark.scss';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('nav-bar', require('./components/layout/NavBar.vue').default);
Vue.component('gw-account', require('./components/account/Main.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            routes: Route,
            token: Token,
            auth: Auth,
            swal: Swal,
            gw_object: GWObject
        }
    }
});
