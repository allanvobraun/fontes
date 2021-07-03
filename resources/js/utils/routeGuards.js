import store from '../stores/index';

export function authRequired(to, from, next) {
  if (!store.getters["user/isAuthenticated"] && from.name !== 'login') {
    console.log("volta para o login")
    next({ name: 'login' });
  } else if (store.getters["user/isAuthenticated"]) {
    console.log("vai para a home")
    next();
  }
}
