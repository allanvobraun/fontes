<template>
  <b-container fluid class="h-100 d-flex flex-column justify-content-center align-content-center">
    <b-row align-h="center" align-v="center">
      <b-col cols="4">
        <b-card>
          <template #header>
            <h3 class="mb-0">Conecte-se</h3>
          </template>
          <login-form></login-form>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import LoginForm from "components/LoginForm";

export default {
  name: "UserLogin",
  components: {LoginForm}
}
</script>
