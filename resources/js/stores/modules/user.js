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

  async setCookie() {
    const request = await axios.get('sanctum/csrf-cookie');
    console.log("cookie");
    return request;
  },

  async login({commit, dispatch}, payload) {
    await axios.post('api/login', payload);
    commit('setAuth', true);

    const response = await axios.get('api/user');

    commit('setUser', response.data.data);
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
