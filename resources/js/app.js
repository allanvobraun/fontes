import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Vue from "vue";
import App from "./components/App.vue";
import Notifications from "vue-notification";
import router from "./router";
import helpers from "./utils/helpers";
import store from "./stores/index";


require("./bootstrap");

import {BootstrapVue} from "bootstrap-vue";

Vue.use(BootstrapVue);
Vue.use(Notifications);

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
