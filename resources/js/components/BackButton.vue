<template>
  <b-button @click="$router.go(-1)" variant="info">
    <BIconCaretLeft></BIconCaretLeft>Voltar
  </b-button>
</template>

<script>
import {BIconCaretLeft} from 'bootstrap-vue';

export default {
  components: {
    BIconCaretLeft
  },
  props: ["link"]
};
</script>

<style>
</style>
