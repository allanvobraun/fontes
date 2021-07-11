import Vue from "vue";
import VueRouter from "vue-router";
import {authRequired} from "utils/routeGuards";

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {
      path: '/login',
      name: 'login',
      component: () => import('views/UserLoginView')
    },
    {
      path: "/",
      component: () => import('views/app/AppRootView'),
      beforeEnter: authRequired,
      children: [
        {
          path: '',
          name: 'home',
          component: () => import("views/app/HomeDashboardView.vue"),
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
          component: () => import("views/app/FontesView.vue"),
          meta: {title: "Todas as fontes"}
        },
        {
          path: "new",
          name: "novo",
          component: () => import("views/app/NewRepairView.vue"),
          meta: {title: "Novo registro"}
        },

      ]
    },
  ],
  mode: "history"
});
