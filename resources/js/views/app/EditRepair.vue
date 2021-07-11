<template>
  <div class="mx-5">
    <repair-form action="put"></repair-form>
  </div>
</template>

<script>
import RepairForm from "components/RepairForm";
import metaMixin from "utils/metaMixin";

export default {
  components: {RepairForm},
  props: ['cod_interno', 'id'],
  mixins: [metaMixin],
  computed: {
    title() {
      return `Editando fonte ${this.cod_interno}`;
    }
  }
}

</script>
