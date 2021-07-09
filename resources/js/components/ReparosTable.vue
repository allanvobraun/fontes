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

export default {
  components: {
    BackButton
  },
  computed: {
    codigo() {
      return this.$route.params.cod_interno;
    }
  },
  methods: {
    getRows(page) {
      this.items = [];
      const url = `/api/fontes/${this.codigo}/reparos`;
      axios
        .get(url)
        .then(response => {
          this.items = response.data.data;
        })
        .catch(error => {
          let erros = error.response.data.erros;
          _.mapValues(erros, err => {
            notify.error('Erro ao procurar reparos', err[0]);
          });
        });
    }
  },
  mounted() {
    this.getRows(1);
  },
  data() {
    return {
      fields: [
        {
          key: "desc_problema",
          label: "Problema"
        },
        { key: "peças" },
        { key: "status" },
        {
          key: "valor",
          formatter: value => {
            if (value > 0) {
              return value.toLocaleString("pt-br", {
                minimumFractionDigits: 2
              });
            } else {
              return 0;
            }
          }
        },
        { key: "data" }
      ],
      items: []
    };
  }
};
</script>
