import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Vue from "vue";
import App from "./components/App.vue";
import Notifications from "vue-notification";
import router from "./router";
import helpers from "./helpers";
import store from "./stores/index";
import vuescroll from 'vue-scroll';


require("./bootstrap");

import {BootstrapVue} from "bootstrap-vue";

Vue.use(BootstrapVue);
Vue.use(Notifications);
Vue.use(vuescroll);

// helpers
Vue.use({
  install() {
    Vue.helpers = helpers;
    Vue.prototype.$helpers = helpers;
  }
});

// função global
Vue.mixin({
  methods: {
    notify(title, body, type) {
      this.$notify({
        group: "alert",
        title: title,
        text: body,
        type: type
      });
    }
  }
});

const app = new Vue({
  el: "#app",
  components: {
    App
  },
  router,
  store
});
