<template>
  <router-link :to="link">
    <img :src="icone" alt="ferro de solda" :style="size" />
  </router-link>
</template>

<script>
import icon from "images/soldering-iron.svg";
export default {
  props: {
    codigo: String,
    width: String,
    height: String
  },
  data() {
    return {
      icone: icon,
      size: `width:${this.width};height:${this.height};`
    };
  },
  computed: {
    link() {
      return `/fontes/${this.codigo}/reparos`;
    }
  }
};
</script>
