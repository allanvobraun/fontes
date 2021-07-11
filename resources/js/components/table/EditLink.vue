<template>
  <router-link :to="{name: 'editar', params: this.routeParams}" class="table-link">
    <BIconPencilSquare variant="dark" class="table-icon" />
  </router-link>
</template>

<script>
import { BIconPencilSquare } from 'bootstrap-vue';
import TableAction from "components/table/TableAction";

export default {
  extends: TableAction,
  components: {BIconPencilSquare},
};
</script>
