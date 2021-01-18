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
  busy(state) {
    return state.filter !== '' || state.loading;
  },
  filter(state) {
    return state.filter;
  }
};

const actions = {
  fetchFontes: debounce(function ({state, commit, getters}) {

    if (state.page >= state.last_page || getters.busy) {
      return;
    }
    state.loading = true;

    commit('add_page');
    const url = `/api/fontes?page=${state.page}`;
    return axios.get(url).then(response => {
      commit('union_items', response.data.data);
      commit('set_last_page', response.data.meta.last_page ?? 2);
      state.loading = false;
    });
  }, 800),
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
