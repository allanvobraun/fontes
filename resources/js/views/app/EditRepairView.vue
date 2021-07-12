<template>
  <div class="mx-5">
    <repair-form action="put"></repair-form>
  </div>
</template>

<script>
import RepairForm from "components/RepairForm";
import metaMixin from "utils/metaMixin";
import notify from "utils/notify";

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
    this.getResources();
  },
  methods: {
    async getResources() {
      try {
        const fonteResponse = await axios.get(`/api/fontes/${this.id}`);
        this.fonte = fonteResponse.data.data;

        const reparoResponse = await axios.get(`api/fontes/${this.id}/reparos`);
        this.reparos = reparoResponse.data.data;

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
