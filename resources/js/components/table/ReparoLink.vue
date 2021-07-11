<template>
  <router-link :to="endpoint" class="table-link">
    <img :src="icon" alt="ferro de solda" class="table-icon"/>
  </router-link>
</template>

<script>
import icon from "images/soldering-iron.svg";
import TableAction from "components/table/TableAction";


export default {
  extends: TableAction,
  components: {icon},
  data() {
    return {
      icon
    };
  },
};
</script>
