<template>
  <b-container
    :style="{backgroundImage: `url(${randomImage})`}"
    fluid
    class="login-container h-100 d-flex flex-column justify-content-center align-content-center"
  >
    <b-row align-h="center" align-v="center">
      <b-col cols="4">
        <b-card class="login-card">
          <template #header>
            <h3 class="mb-0" style="color: white">Conecte-se</h3>
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
  components: {LoginForm},
  data() {
    return {
      wallpapers: this.$helpers.getWalpapersList()
    }
  },
  computed: {
    randomImage() {
      return _.sample(this.wallpapers);
    }
  }
}
</script>
<style scoped>
.login-container {
  background-size: cover;
  background-repeat: no-repeat;
}

.login-card {
  background-color: rgba(0,0,0,0.8) !important;
  height: 310px;
}
</style>
