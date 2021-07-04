import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Vue from "vue";
import App from "./components/App.vue";
import router from "./router";
import helpers from "./utils/helpers";
import store from "./stores/index";


require("./bootstrap");

import {BootstrapVue} from "bootstrap-vue";

Vue.use(BootstrapVue);

// helpers
Vue.use({
  install() {
    Vue.helpers = helpers;
    Vue.prototype.$helpers = helpers;
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
