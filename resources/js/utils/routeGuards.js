import store from '../stores/index';

export function authRequired(to, from, next) {
  if (!store.getters["user/isAuthenticated"] && from.name !== 'login') {
    next({ name: 'login' });
  } else if (store.getters["user/isAuthenticated"]) {
    next();
  }
}
