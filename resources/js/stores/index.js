import Vue from 'vue';
import Vuex from 'vuex';
import fontes from "./modules/fontes";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    fontes
  }
});
