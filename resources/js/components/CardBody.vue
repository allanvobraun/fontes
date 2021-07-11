<template>
  <b-card v-bind:header="title" header-tag="header" class="w-100 h-100">
    <slot></slot>
  </b-card>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters('meta', ["title"]),
  }
};
</script>
