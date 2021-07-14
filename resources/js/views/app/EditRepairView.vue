<template>
  <div class="mx-5">
    <repair-form action="edit"></repair-form>
    <div class="reparos-pagination">
      <b-pagination
        v-if="reparosCount > 1"
        v-model="actualPage"
        :total-rows="reparosCount"
        :per-page="1"
        @change="changeReparo"
        size="lg"
        hide-goto-end-buttons
        pills
      ></b-pagination>
      <h2 v-else>
        Essa fonte só tem um reparo cadastrado
      </h2>
    </div>
  </div>
</template>

<script>
import RepairForm from "components/RepairForm";
import metaMixin from "utils/metaMixin";
import notify from "utils/notify";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {RepairForm},
  props: ['cod_interno', 'id'],
  mixins: [metaMixin],
  data() {
    return {
      actualPage: 1
    }
  },
  mounted() {
    this.getResources();
  },
  methods: {
    ...mapActions('reparoForm', ["getFontById", "setReparoByIndex"]),
    changeReparo(newPage) {
      this.setReparoByIndex(newPage - 1);
    },
    async getResources() {
      try {
        await this.getFontById(this.id);

      } catch (e) {
        notify.error("Erro ao buscar informações da fonte", "Tente novamente mais tarde");
        return;
      }
      if (this.reparosCount > 1) {
        notify.info("Use as setas para trocar entre reparos");
      }
    },
  },
  computed: {
    ...mapGetters('reparoForm', ["reparosCount", "fonteObject"]),
    title() {
      return `Editando fonte '${this.fonteObject.cod_interno}'`;
    },
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
