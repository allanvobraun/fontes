import Vue from "vue";
import VueRouter from "vue-router";
import FontesTable from "./components/FontesTable.vue";
import ReparosTable from "./components/ReparosTable.vue";
import ConcertoForm from "./components/ConcertoForm.vue";
import HomeDashboard from "./components/HomeDashboard.vue";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeDashboard,
            meta: { title: "Home" }
        },
        {
            path: "/fontes/:cod_interno/reparos",
            name: "reparos",
            component: ReparosTable,
            meta: { title: "Todos os reparos da fonte" }
        },
        {
            path: "/fontes",
            name: "fontes",
            component: FontesTable,
            meta: { title: "Todas as fontes" }
        },

        {
            path: "/new",
            name: "novo",
            component: ConcertoForm,
            meta: { title: "Novo registro" }
        }
    ],
    mode: "history"
});
