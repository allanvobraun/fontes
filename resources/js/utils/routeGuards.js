import store from '../stores/index';

export function AuthRequired(to, from, next) {
  if (!store.getters["isAuthenticated"] && from.name !== 'login') {
    next({ name: 'login' });
  } else if (store.getters["isAuthenticated"]) {
    next();
  }
}
