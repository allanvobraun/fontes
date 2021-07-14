<template>
  <b-button variant="transparent" class="table-icon-wrapper" @click="$emit('click', fonteObject)">
    <b-icon-trash class="table-icon"></b-icon-trash>
  </b-button>
</template>

<script>
import {BIconTrash} from 'bootstrap-vue';
import TableAction from "components/table/TableAction";

export default {
  extends: TableAction,
  components: {BIconTrash},
};
</script>
<style scoped>
button {
  padding: 0;
}
</style>
