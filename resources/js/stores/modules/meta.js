const state = {
  title: ""
};

const getters = {
  title: state => state.title,
};

const mutations = {
  setTitle(state, payload) {
    state.title = payload
  },
};

const actions = {};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
