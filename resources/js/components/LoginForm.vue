<template>
  <b-form @submit.prevent="formSubmit" class="h-100 d-flex flex-column justify-content-around">
    <div class="my-2">
      <b-input-group size="md" class="my-4">
        <b-input-group-prepend >
          <b-input-group-text class="login-input-append">
            <b-icon-envelope-fill variant="dark"></b-icon-envelope-fill>
          </b-input-group-text>
        </b-input-group-prepend>
        <b-form-input
          id="username"
          v-model="form.email"
          type="email"
          placeholder="Email"
        ></b-form-input>
      </b-input-group>
      <b-input-group size="md" class="my-4">
        <b-input-group-prepend>
          <b-input-group-text class="login-input-append">
            <b-icon-key-fill variant="dark"></b-icon-key-fill>
          </b-input-group-text>
        </b-input-group-prepend>
        <b-form-input
          id="password"
          v-model="form.password"
          type="password"
          placeholder="Senha"
        ></b-form-input>
      </b-input-group>
    </div>
    <div class="d-flex justify-content-center align-content-center">
      <b-button type="submit" size="lg" variant="primary">Login</b-button>
    </div>
  </b-form>
</template>

<script>
import {BIconEnvelopeFill, BIconKeyFill} from 'bootstrap-vue';
import { mapActions } from "vuex";
import notify from "utils/notify";

export default {
  components: {BIconEnvelopeFill, BIconKeyFill},
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },

  mounted() {
    this.setCookie().then(() => {
      this.signOut();
    });
  },
  methods: {
    ...mapActions('user', ['login', 'setCookie', 'signOut']),

    formSubmit() {
      this.login(this.form).then(() => {
        this.$router.push({name: 'home'});
      }).catch(() => {
        notify.error("Ocorreu um erro ao se conectar.", "Verifique suas credenciais");
      });
    },
  }
}
</script>
