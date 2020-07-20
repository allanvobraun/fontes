<template>
  <b-card v-bind:header="titulo" header-tag="header" class="w-100">
    <slot></slot>
  </b-card>
</template>

<script>
export default {
  computed: {
    titulo() {
      return this.$route.meta.title
    }
  },
};
</script>
