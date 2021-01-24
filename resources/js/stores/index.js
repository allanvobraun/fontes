import Vue from 'vue';
import Vuex from 'vuex';
import fontes from "./modules/fontes";
import user from "./modules/user";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    fontes,
    user
  }
});
