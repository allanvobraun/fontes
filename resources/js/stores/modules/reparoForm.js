function getDefaultState() {
  return {
    fonte: {
      id: "",
      cod_font: "",
      cod_interno: "",
      modelo: "",
      fabricante: ""
    },
    reparo: {
      id: "",
      desc_problema: "",
      peças: "",
      status: "OK",
      valor: 0
    },
    reparos: [],
    httpMethod: 'post'
  };
}


const state = getDefaultState();

const getters = {
  fonteObject: state => state.fonte,
  reparoObject: state => state.fonte,
};

const mutations = {
  setFonte(state, payload) {
    state.fonte = payload
  },
  setReparo(state, payload) {
    state.reparo = payload
  },
  setReparos(state, payload) {
    state.reparo = payload
  },
  setHttpMethod(state, payload) {
    state.httpMethod = payload
  },
  reset(state) {
    Object.assign(state, getDefaultState())
  }
};

const actions = {
  async submitFonte({state, commit}, payload) {
    commit('setFonte', payload);
    const response = await axios[state.httpMethod]("/api/fontes", state.fonte);
    commit('setFonte', response.data.data);
  },

  async submitReparo({state, commit}, payload) {
    commit('setReparo', payload);
    const url = `/api/fontes/${state.fonte.id}/reparos`;

    const response = await axios[state.httpMethod](url, payload);
    commit('setReparo', response.data.data);
  },

  async getFontByCod({state, commit}, payload) {
    const response = await axios.get(`/api/fontes/cod/${payload}`);
    const fonte = response.data.data;
    if (fonte) {
      commit('setFonte', response.data.data);
    }
  },

  async getFontById({state, commit}, payload) {
    const response = await axios.get(`/api/fontes/${payload}`);
    const fonte = response.data.data;
    if (fonte) {
      commit('setFonte', fonte);
      commit('setReparos', fonte.reparos ?? []);
      commit('setReparo', state.reparos[0]);
    }
  },

  resetState({commit}) {
    commit('reset');
  },

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
