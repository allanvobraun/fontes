<template>
  <b-input-group>
    <b-form-input
      v-bind="$attrs"
      v-on="$listeners"
      :list="listID"
      ref="input-with-list"
      @keyup="update"
      @blur="onSelected"
    ></b-form-input>
    <b-form-datalist :id="listID" ref="input-list" :options="options"></b-form-datalist>
    <b-input-group-append>
      <b-button variant="info">
        <b-icon-search></b-icon-search>
      </b-button>
    </b-input-group-append>
  </b-input-group>
</template>

<script>
  import {BIconSearch} from 'bootstrap-vue';
  import AutoCompleteSearch from "components/search/AutoCompleteSearch";

  export default {
    inheritAttrs: false,
    name: "AutoCompleteSearchButton",
    components: {BIconSearch},
    extends: AutoCompleteSearch,
  }
</script>
