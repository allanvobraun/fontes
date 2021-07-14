<template>
  <div>
    <b-form-input
      v-bind="$attrs"
      v-on="$listeners"
      :list="listID"
      ref="input-with-list"
      @keyup="update"
      @blur="onSelected"
    ></b-form-input>
    <b-form-datalist :id="listID" ref="input-list" :options="options"></b-form-datalist>
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
  computed: {
    listID() {
      return this._uid.toString();
    }
  },
  methods: {
    async update(event) {
      this.options = await this.search(event.target.value);
    },

    onSelected(event) {
      const value = event.target.value;
      if (value !== "") {
        this.$emit("result-selected", value);
      }
    },
  }
};
</script>
