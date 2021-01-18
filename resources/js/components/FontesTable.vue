<template>
  <div v-infinite-scroll="fetchFontes" :infinite-scroll-immediate-check="false">
    <b-row no-gutters class="mb-3">
      <b-col sm="4" class="my-1">
        <b-form-group
          label="Filtro"
          label-for="filter-input"
          label-size="md"
          class="mb-0"
        >
          <b-input-group size="md">
            <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Digite para pesquisar"
            ></b-form-input>

            <b-input-group-append>
              <b-button variant="outline-info" @click="filter = ''">Limpar</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
    <b-table
      striped
      bordered
      outlined
      :items="items"
      :fields="fields"
      :filter="filter"
      head-variant="dark"
      id="fontes-table"
    >
      <template v-slot:cell(reparos)="data">
        <reparo-link width="3rem" height="2rem" :codigo="data.item.cod_interno"></reparo-link>
      </template>
    </b-table>
    <b-row no-gutters class="my-3">
      <b-col offset-sm="4" sm="4" class="d-flex justify-content-center align-content-center">
        <b-spinner v-if="loading" label="Carregando peraee..."></b-spinner>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import ReparoLink from "./ReparoLink.vue";
import infiniteScroll from 'vue-infinite-scroll';
import {mapGetters, mapActions} from 'vuex';

export default {
  components: {ReparoLink},
  directives: {infiniteScroll},
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
        {key: "modelo"},
        {key: "fabricante"},
        {
          key: "reparos",
          label: "Reparos",
          thStyle: "width: 5%",
          tdClass: "d-flex justify-content-center icon-cell"
        }
      ],
      filter: '',
    };
  },
  computed: {
    ...mapGetters('fontes', [
      "items",
      "loading"
    ])
  },
  methods: {
    ...mapActions('fontes', [
      'fetchFontes'
    ]),
  },
  mounted() {
    this.fetchFontes();
  },
};
</script>
<style>
.icon-cell {
  padding: 0.60rem 0 !important;
}
</style>
