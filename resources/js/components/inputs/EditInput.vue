<template>
  <b-input-group>
    <b-form-input
      v-bind="$attrs"
      v-on="$listeners"
      :disabled="!boolEditable"
    ></b-form-input>
    <b-input-group-append>
      <b-button variant="outline-info" @click="boolEditable = !boolEditable">
        <b-icon-pencil-square variant="dark"/>
      </b-button>
    </b-input-group-append>
  </b-input-group>
</template>

<script>
  import { BIconPencilSquare } from 'bootstrap-vue';
  export default {
    inheritAttrs: false,
    name: "EditInput",
    components: {BIconPencilSquare},
    data() {
      return {
        boolEditable: this.editable
      }
    },
    props: {
      editable: {
        type: Boolean,
        default: false,
      }
    }
  }
</script>

<style scoped>

</style>
