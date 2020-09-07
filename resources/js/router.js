import Vue from "vue";
import VueRouter from "vue-router";
import FontesTable from "components/FontesTable.vue";
import ReparosTable from "components/ReparosTable.vue";
import ConcertoForm from "components/ConcertoForm.vue";
import HomeDashboard from "components/HomeDashboard.vue";
import EditorFontes from "components/EditorFontes.vue";

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
            meta: {
                title: route => `Todos os reparos da fonte "${route.params.cod_interno}"`
            } ,

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
        },
        {
          path: "/fontes/edit/:cod_interno?",
          name: "editar",
          component: EditorFontes,
          meta: {
            title: route => `Editando ${route.params.cod_interno}`.replace('undefined', '')
          }
        }
    ],
    mode: "history"
});
