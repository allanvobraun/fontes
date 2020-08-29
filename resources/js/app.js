import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Vue from "vue";
import App from "./components/App.vue";
import Notifications from "vue-notification";
import router from "./router";
import helpers from "./helpers";
require("./bootstrap");

import { BootstrapVue } from "bootstrap-vue";

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
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
    router: router
});
