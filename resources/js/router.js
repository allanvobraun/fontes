import Vue from "vue";
import VueRouter from "vue-router";
import {AuthRequired} from "./utils/routeGuards";

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {
      path: "/",
      component: () => import('components/MainApp'),
      beforeEnter: AuthRequired,
      children: [
        {
          path: '',
          name: 'home',
          component: () => import("components/HomeDashboard.vue"),
          meta: {title: "Home"},
        },
        {
          path: "fontes/:cod_interno/reparos",
          name: "reparos",
          component: () => import("components/ReparosTable.vue"),
          meta: {
            title: route => `Todos os reparos da fonte "${route.params.cod_interno}"`
          },
        },
        {
          path: "fontes",
          name: "fontes",
          component: () => import("components/FontesTable.vue"),
          meta: {title: "Todas as fontes"}
        },
        {
          path: "new",
          name: "novo",
          component: () => import("components/ConcertoForm.vue"),
          meta: {title: "Novo registro"}
        },
        {
          path: "fontes/edit/:cod_interno?",
          name: "editar",
          component: () => import("components/EditorFontes.vue"),
          meta: {
            title: route => `Editando ${route.params.cod_interno}`.replace('undefined', '')
          }
        }
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('components/UserLogin')
    }
  ],
  mode: "history"
});
