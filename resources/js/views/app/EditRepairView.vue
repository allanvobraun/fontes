<template>
  <div class="mx-5">
    <repair-form action="edit"></repair-form>
    <div class="reparos-pagination">
      <b-pagination-nav
        :number-of-pages="3"
        size="lg"
        pills
      ></b-pagination-nav>
    </div>
  </div>
</template>

<script>
import RepairForm from "components/RepairForm";
import metaMixin from "utils/metaMixin";
import notify from "utils/notify";
import {mapActions, mapMutations} from "vuex";

export default {
  components: {RepairForm},
  props: ['cod_interno', 'id'],
  mixins: [metaMixin],
  data() {
    return {
      fonte: {},
      reparos: []
    }
  },
  mounted() {
    this.getResources().then(() => {
      this.setHttpMethod('put');
    });
  },
  methods: {
    ...mapActions('reparoForm', ["getFontById"]),
    ...mapMutations('reparoForm', ["setHttpMethod"]),
    async getResources() {
      try {
        await this.getFontById(this.id);

      } catch (e) {
        notify.error("Erro ao buscar informações da fonte", "Tente novamente mais tarde");
        console.log(e);
        return;
      }
      notify.info("Use as setas para trocar entre reparos");
    }
  },
  computed: {
    title() {
      return `Editando fonte ${this.cod_interno}`;
    }
  },
}
</script>
<style scoped>
.reparos-pagination {
  margin: auto 0;
  display: flex;
  flex-direction: column;
  align-items: center;
}

</style>
