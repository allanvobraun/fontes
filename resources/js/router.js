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
        },
        {
          path: "fontes/:id/reparos",
          name: "reparos",
          component: () => import("components/ReparosTable.vue"),
          props: true
        },
        {
          path: "fontes",
          name: "fontes",
          component: () => import("views/app/FontesTableView.vue"),
        },
        {
          path: "new",
          name: "novo",
          component: () => import("views/app/NewRepairView.vue"),
        },
        {
          path: "edit/:id",
          name: "editar",
          component: () => import("views/app/EditRepairView.vue"),
        },
      ]
    },
  ],
  mode: "history"
});
