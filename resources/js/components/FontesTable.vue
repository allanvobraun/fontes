<template>
  <div>
    <b-table
      sticky-header
      striped
      bordered
      outlined
      :items="items"
      :fields="fields"
      head-variant="dark"
    ></b-table>
  </div>
</template>

<script>
export default {
  methods: {
    // desaninha um objeto json com um lista
    jsonToLine(data_obj) {
      // remove reparos do obje  faz uma copia
      const { reparos, ...fonte } = data_obj;
      for (let i = 0; i < data_obj.reparos.length; i++) {
        let reparo = data_obj.reparos[i];
        let obj = { ...fonte, ...reparo };
        this.items.push(obj);
      }
    }
  },
  mounted() {
    axios.get("/api/fontes").then(response => {
      _.forEach(response.data.data, data => this.jsonToLine(data));
    });
  },
  data() {
    return {
      fields: [
        {
          key: "cod_font",
          sortable: true,
          label: "Código Fonte"
        },
        {
          key: "cod_interno",
          sortable: true,
          label: "Código Interno"
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
            return value.toLocaleString('pt-br', {minimumFractionDigits: 2});
          }
        },
        { key: "data" }
      ],
      items: []
    };
  }
};
</script>
