<template>
  <b-button @click="$router.go(-1)" variant="info" class="d-flex flex-row">
    <i class="material-icons">arrow_back_ios</i>
    <span>Voltar</span>
  </b-button>
</template>

<script>
export default {
  props: ["link"]
};
</script>

<style>
</style>