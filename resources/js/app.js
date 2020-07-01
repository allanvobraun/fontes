import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Vue from 'vue';
import App from './components/App.vue';

import router from './router';
require('./bootstrap');

import { BootstrapVue } from 'bootstrap-vue';

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router: router
});
