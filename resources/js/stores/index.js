import Vue from 'vue';
import Vuex from 'vuex';
import fontes from "@/stores/modules/fontes";
import user from "@/stores/modules/user";
import meta from "@/stores/modules/meta";
import reparoForm from "@/stores/modules/reparoForm";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    fontes,
    user,
    meta,
    reparoForm
  }
});
