import Vue from 'vue';
import VueRouter from 'vue-router';
import TestB from './components/TestB.vue';
import FontesTable from './components/FontesTable.vue';


Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/show', name: 'mostrar', component: FontesTable},
        {path: '/b', component: TestB},
    ],
    mode: 'history'
});