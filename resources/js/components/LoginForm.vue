<template>
  <div>
    <div>
      <b-input-group size="md" class="my-3">
        <b-input-group-prepend>
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
      <b-input-group size="md" class="my-3">
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
      <b-button size="lg" variant="primary">Login</b-button>
    </div>

  </div>
</template>

<script>
import {BIconEnvelopeFill, BIconKeyFill} from 'bootstrap-vue';

export default {
  components: {BIconEnvelopeFill, BIconKeyFill},
  data() {
    return {
      form: {
        email: '',
        password: ''

      }
    }
  }
}
</script>
