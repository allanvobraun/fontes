<template>
  <div class="mx-5">
    <repair-form></repair-form>
  </div>
</template>

<script>
import RepairForm from "components/RepairForm";
import metaMixin from "utils/metaMixin";

export default {
  components: {RepairForm},
  mixins: [metaMixin],
  computed: {
    title: () => 'Novo registro'
  }
}

</script>
