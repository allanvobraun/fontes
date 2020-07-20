<template>
  <b-card v-bind:header="titulo" header-tag="header" class="w-100">
    <slot></slot>
  </b-card>
</template>

<script>
export default {
  computed: {
    titulo() {
      let title = this.$route.meta.title;
      if (typeof title === "function") {
        return title(this.$route);
      } else {
        return title;
      }
    }
  }
};
</script>
