<template>
  <auto-complete-search-button
    :search="searchLike"
    v-bind="$attrs"
    v-on="$listeners"
  >
  </auto-complete-search-button>
</template>

<script>
  import AutoCompleteSearchButton from "components/search/AutoCompleteSearchButton.vue";
  export default {
    name: "AutoCompleteNSFabricante",
    inheritAttrs: false,
    components: {AutoCompleteSearchButton},
    methods: {
      searchLike(input) {
        if (input.length < 1) return [];
        const url = `/api/fontes/search?query=${input}&attribute=cod_font`;
        return axios.get(url).then(response => {
          return response.data.data;
        });
      },
    }
  }
</script>

<style scoped>

</style>
