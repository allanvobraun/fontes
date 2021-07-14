<template>
  <div v-infinite-scroll="fetchFontes" infinite-scroll-immediate-check="false">
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
              v-model="filterQuery"
              type="search"
              placeholder="Digite para pesquisar"
            ></b-form-input>

            <b-input-group-append>
              <b-button variant="outline-info" @click="searchFontes(filterQuery)">
                <b-icon-search></b-icon-search>
              </b-button>
              <b-button variant="outline-info" @click="wipeFilter">
                Limpar
              </b-button>
            </b-input-group-append>

          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
    <b-table
      striped
      bordered
      outlined
      show-empty
      :items="items"
      :fields="fields"
      head-variant="dark"
      id="fontes-table"
      empty-text="Nenhuma fonte foi encontrada"
    >

      <template #cell(edit)="data">
        <edit-link :fonte-object="data.item" ></edit-link>
      </template>

      <template #cell(reparos)="data">
        <reparo-link :fonte-object="data.item"></reparo-link>
      </template>

      <template #empty="scope">
        <h4 class="d-flex flex-row justify-content-center align-content-center">
          {{ scope.emptyText }}
        </h4>
      </template>

      <template #custom-foot>
        <b-tr>
          <b-td colspan="8" variant="dark" class="text-center">
            <b-button variant="outline-info" @click="fetchFontes">
              <BIconCaretDownFill/>
            </b-button>
          </b-td>
        </b-tr>
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
import infiniteScroll from 'vue-infinite-scroll';
import { mapGetters, mapActions } from 'vuex';
import { BIconSearch, BIconCaretDownFill } from 'bootstrap-vue';
import EditLink from "components/table/EditLink";
import ReparoLink from "components/table/ReparoLink";
import metaMixin from "utils/metaMixin";


export default {
  components: {EditLink, ReparoLink, BIconSearch, BIconCaretDownFill},
  mixins: [metaMixin],
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
          key: "data",
          sortable: true,
        },
        {
          key: "edit",
          label: "Editar",
          thStyle: "width: 5%",
          tdClass: "text-center icon-cell"
        },
        {
          key: "reparos",
          label: "Reparos",
          thStyle: "width: 5%",
          tdClass: "text-center icon-cell"
        },
      ],
      filterQuery: ''
    };
  },
  computed: {
    ...mapGetters('fontes', [
      "items",
      "loading",
    ]),
    title: () => 'Todas as fontes'
  },
  methods: {
    ...mapActions('fontes', [
      'fetchFontes',
      'searchFontes'
    ]),

    wipeFilter() {
      this.filterQuery = '';
      this.searchFontes('');
    }
  },
  mounted() {
    if (this.items.length === 0) {
      this.fetchFontes();
    }
  },
};
</script>
<style>
.icon-cell {
  padding: 0.60rem 0 !important;
  vertical-align: middle !important;
}

table {
  font-size: .85rem;
}
</style>
