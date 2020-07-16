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
      id="fontes-table"
    ></b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="fontes-table"
      @input="getRows"
    ></b-pagination>
  </div>
</template>

<script>
export default {
  methods: {
    // desaninha um objeto json com um lista
    jsonToLine(data_obj) {
      // remove reparos do obje  faz uma copia
      const { reparos, ...fonte } = data_obj;

      if (data_obj.reparos.length > 0) {
        for (let i = 0; i < data_obj.reparos.length; i++) {
          let reparo = data_obj.reparos[i];
          let obj = { ...fonte, ...reparo };
          this.items.push(obj);
        }
      } else {
        let obj = { ...fonte};
        this.items.push(obj);
      }
    },
    getRows(page) {
      this.items = [];
      const url = `/api/fontes?page=${page}`;
      axios.get(url).then(response => {
        _.forEach(response.data.data, data => this.jsonToLine(data));
        this.perPage = response.data.meta.per_page;
        this.currentPage = response.data.meta.current_page;
        this.rows = response.data.meta.total_join;
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
          key: "cod_interno",
          sortable: true,
          label: "N/S Rework"
        },
        {
          key: "cod_font",
          sortable: true,
          label: "N/S Fabricante"
        },
        { key: "modelo" },
        { key: "fabricante" },
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
      items: [],
      currentPage: 1,
      perPage: 0,
      rows: 0
    };
  }
};
</script>
