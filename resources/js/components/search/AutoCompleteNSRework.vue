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
  name: "AutoCompleteNSRework",
  inheritAttrs: false,
  components: {AutoCompleteSearchButton},
  methods: {
    searchLike: _.debounce(function (input) {
      if (input.length < 2) return [];
      const url = `/api/fontes/search?query=${input}&attribute=cod_interno`;
      return axios.get(url).then(response => {
        return response.data.data;
      }).catch(() => {});
    }, 300),
  }
}
</script>
