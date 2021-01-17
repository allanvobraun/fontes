const state = {
  items: [],
  page: 0,
  last_page: 2,
  loading: false,
};

const getters = {
  items(state) {
    return state.items;
  },
  loading(state) {
    return state.loading;
  }
};

const actions = {
  fetchFontes({state, commit}) {
    console.log("fech")
    if (state.page >= state.last_page) {
      return;
    }
    state.loading = true;
    _.debounce(() => {
      commit('add_page');
      const url = `/api/fontes?page=${state.page}`;
      return axios.get(url).then(response => {
        commit('union_items', response.data.data);
        commit('set_last_page', response.data.meta.last_page ?? 2);
        state.loading = false;
      });
    }, 500)();
  }
};

const mutations = {
  add_page(state) {
    state.page += 1;
  },
  set_last_page(state, payload) {
    state.last_page = payload;
  },
  union_items(state, payload) {
    state.items = _.unionBy(state.items, payload, 'cod_interno');
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
