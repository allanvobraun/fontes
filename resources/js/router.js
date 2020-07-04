import Vue from 'vue';
import VueRouter from 'vue-router';
import FontesTable from './components/FontesTable.vue';
import ConcertoForm from './components/ConcertoForm.vue'; 
import HomeDashboard from './components/HomeDashboard.vue';  


Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', name: 'home', component: HomeDashboard, meta:'Home'},
        {path: '/show', name: 'mostrar', component: FontesTable, meta:'Todos os registros'},
        {path: '/new', name: 'novo', component: ConcertoForm, meta:'Novo registro'},
    ],
    mode: 'history'
});