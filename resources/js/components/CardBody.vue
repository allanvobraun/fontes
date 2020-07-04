<template>
  <b-card
    v-bind:header="titulo"
    header-tag="header"
    class="w-100"
  >
    <slot></slot>
  </b-card>
</template>

<script>
export default {
  data() {
    return {
      titulo: this.$route.meta
    }
  },
  updated() {
    this.titulo = this.$route.meta
  }

};
</script>
