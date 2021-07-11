<template>
  <router-link :to="link">
    <img :src="icone" alt="ferro de solda" style="width: 2rem; height: 2rem" />
  </router-link>
</template>

<script>
import icon from "images/soldering-iron.svg";
export default {
  props: {
    codigo: String,
  },
  data() {
    return {
      icone: icon,
    };
  },
  computed: {
    link() {
      return `/fontes/${this.codigo}/reparos`;
    }
  }
};
</script>
