const state = {
  currentUser: {
    email: '',
    name: '',
  },
  loginError: null,
  auth: false,
};

const getters = {
  isAuthenticated: state => state.auth,
  currentUser: state => state.currentUser,
};

const mutations = {
  setUser(state, payload) {
    state.currentUser = payload
  },
  setLogout(state) {
    state.currentUser = {};
    state.auth = false;
  },
  setAuth(state, payload) {
    state.auth = payload;
  }
};

const actions = {
  async login({commit}, payload) {
    await axios.get('sanctum/csrf-cookie');
    await axios.post('api/login', payload);
    commit('setAuth', true);

    const user = await axios.get('api/user')
      .then(response => response.data.data);

    commit('setUser', user);
  },

  async signOut({commit}) {
    await axios.post('api/logout');
    commit('setLogout');
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
