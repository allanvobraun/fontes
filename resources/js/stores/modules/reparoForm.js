function getDefaultState() {
  return {
    fonte: {
      id: "",
      cod_font: "",
      cod_interno: "",
      modelo: "",
      fabricante: "",
    },
    reparo: {
      id: "",
      desc_problema: "",
      peças: "",
      status: "OK",
      valor: 0
    },
    reparos: [],
  };
}


const state = getDefaultState();

const getters = {
  fonteObject: state => state.fonte,
  reparoObject: state => state.reparo,
  reparosList: state => state.reparos,
  reparosCount: state => state.reparos.length,
};

const mutations = {
  setFonte(state, payload) {
    state.fonte = payload
  },
  setReparo(state, payload) {
    state.reparo = payload
  },
  setReparos(state, payload) {
    state.reparos = payload
  },
  reset(state) {
    Object.assign(state, getDefaultState())
  }
};

const actions = {
  async saveFonte({state, commit}, payload) {
    const response = await axios.post('/api/fontes', payload);
    return response.data.data;
  },

  async saveReparo({state, commit}, payload) {
    const endpoint = `/api/fontes/${state.fonte.id}/reparos`;
    const response = await axios.post(endpoint, payload);
    return response.data.data;
  },

  async editFonte({state, commit}, payload) {
    const endpoint = `/api/fontes/${state.fonte.id}`;
    const response = await axios.put(endpoint, payload);
    return response.data.data;
  },

  async editReparo({state, dispatch}, payload) {
    const endpoint = `/api/fontes/${state.fonte.id}/reparos/${state.reparo.id}`;
    const response = await axios.put(endpoint, payload);
    await dispatch('getReparosByFonteId', state.fonte.id);
    return response.data.data;
  },

  /**
   * @param {?Object} fonte
   * @param {?Object} reparo
   * @param {string} type edit | save
   * @return {Promise<void>}
   */
  async submit({dispatch, commit}, {fonte, reparo, type}) {

    if (fonte) {
      const fonteResponse = await dispatch(`${type}Fonte`, fonte);
      commit('setFonte', fonteResponse);
    }
    const reparoResponse = await dispatch(`${type}Reparo`, reparo);
    commit('setReparo', reparoResponse);
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

  async getReparosByFonteId({state, commit}, payload) {
    const response = await axios.get(`/api/fontes/${payload}/reparos`);
    const reparos = response.data.data;
    if (reparos) {
      commit('setReparos', reparos);
    }
  },

  resetState({commit}) {
    commit('reset');
  },

  setReparoByIndex({commit, getters}, idx) {
    if (idx > getters.reparosCount - 1) return;
    commit('setReparo', getters.reparosList[idx]);
  }

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
