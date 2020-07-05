<template>
  <div>
    <b-form-input
      v-bind="$attrs"
      v-on="$listeners"
      list="input-list"
      id="input-with-list"
      @keyup="update"
      @blur="onSelected"
    ></b-form-input>
    <b-form-datalist id="input-list" :options="options"></b-form-datalist>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    search: Function,
    list: Array
  },
  data() {
    return {
      options: this.list
    };
  },
  methods: {
    async update(event) {
      const lista = await this.search(event.target.value);
      this.options = lista;
    },
    onSelected(event) {
      const value = event.target.value;
      if (value !== "") {
        this.$emit("result-selected", value);
      }
    }
  }
};
</script>