import {debounce} from 'lodash';

const state = {
  items: [],
  page: 0,
  last_page: 2,
  loading: false,
  filter: '',
};

const getters = {
  items(state) {
    return state.items;
  },
  loading(state) {
    return state.loading;
  },
};

const actions = {
  fetchFontes: debounce(function ({state, commit}) {
    if (state.page >= state.last_page || state.loading) return;

    console.log("executandpo", state.filter);
    state.loading = true;
    commit('add_page');

    const search = state.filter === '' ? '' : `search=${state.filter}`;
    const url = `/api/fontes?page=${state.page}&${search}`;
    return axios.get(url).then(response => {
      commit('union_items', response.data.data);
      commit('set_last_page', response.data.meta.last_page ?? 2);
      state.loading = false;
    });
  }, 800),

  searchFontes({commit, dispatch, state}, newFilter) {
    commit('set_filter', newFilter);
    commit('reset_pagination');
    commit('reset_items');
    return dispatch('fetchFontes');
  },

};

const mutations = {
  add_page(state) {
    state.page += 1;
  },
  set_last_page(state, payload) {
    state.last_page = payload;
  },
  reset_pagination() {
    state.page = 0;
    state.last_page = 2;
  },
  reset_items(state) {
    state.items = [];
  },
  union_items(state, payload) {
    state.items = _.unionBy(state.items, payload, 'cod_interno');
  },
  set_filter(state, payload) {
    state.filter = payload;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
