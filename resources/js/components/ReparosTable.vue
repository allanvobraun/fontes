<template>
  <div>
    <b-table
      sticky-header="50rem"
      striped
      bordered
      outlined
      :items="items"
      :fields="fields"
      head-variant="dark"
      id="reparos-table"
    ></b-table>
    <back-button style="float: right;"></back-button>
  </div>
</template>

<script>
import BackButton from "./BackButton.vue";
import notify from "utils/notify";
import metaMixin from "utils/metaMixin";

export default {
  mixins: [metaMixin],
  components: {
    BackButton
  },
  props: ['cod_interno', 'id'],
  data() {
    return {
      fields: [
        {
          key: "desc_problema",
          label: "Problema"
        },
        {key: "peças"},
        {key: "status"},
        {
          key: "valor",
          formatter: this.formatValue
        },
        {key: "data"}
      ],
      items: []
    };
  },
  computed: {
    url() {
      return `/api/fontes/${this.id}/reparos`;
    },
    title() {
      return `Reparos da fonte: '${this.cod_interno}'`;
    }
  },
  methods: {
    getRows(page) {
      this.items = [];
      axios
        .get(this.url)
        .then(response => {
          this.items = response.data.data;
        })
        .catch(error => {
          let erros = error.response.data.erros;
          _.mapValues(erros, err => {
            notify.error('Erro ao procurar reparos', err[0]);
          });
        });
    },
    formatValue(value) {
      if (value > 0) {
        return value.toLocaleString("pt-br", {
          minimumFractionDigits: 2
        });
      }
      return 0;
    }
  },
  mounted() {
    this.getRows(1);
  },
};
</script>
