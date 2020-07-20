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
    >
      <template v-slot:cell(reparos)="data">
        <reparo-link width="3rem" height="2rem" :codigo="data.item.cod_interno"></reparo-link>
      </template>
    </b-table>
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
import ReparoLink from "./ReparoLink.vue";

export default {
  components: {
    ReparoLink
  },
  methods: {
    getRows(page) {
      this.items = [];
      const url = `/api/fontes?page=${page}`;
      axios.get(url).then(response => {
        this.items = response.data.data;
        this.rows = response.data.meta.total;
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
          key: "reparos",
          label: "Reparos",
          thStyle: "width: 5%",
          tdClass: "d-flex justify-content-center icon-cell"
        }
      ],
      items: [],
      currentPage: 1,
      perPage: 0,
      rows: 0
    };
  }
};
</script>
<style>
.icon-cell {
  padding: 0.60rem 0px !important;
}
</style>