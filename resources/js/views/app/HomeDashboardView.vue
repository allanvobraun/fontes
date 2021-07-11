<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col>
        <b-card
          border-variant="primary"
          header="Ganhos Ano"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        >
          <ganhos-ano-chart ano="2020"></ganhos-ano-chart>

        </b-card>
      </b-col>
      <b-col>
        <b-card
          border-variant="primary"
          header="Ganhos ultimas 3 semanas"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        >
          <ganhos-semana-chart></ganhos-semana-chart>
        </b-card>
      </b-col>
      <b-col>
        <b-card
          border-variant="primary"
          header="Em construção"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        ></b-card>
      </b-col>
    </b-row>
    <b-row>
      <b-col></b-col>
      <b-col></b-col>
      <b-col></b-col>
    </b-row>
    <b-row>
      <b-col></b-col>
      <b-col></b-col>
      <b-col></b-col>
    </b-row>
  </b-container>
</template>

<script>
import GanhosAnoChart from "charts/GanhosAnoChart";
import GanhosSemanaChart from "charts/GanhosSemanaChart";
import metaMixin from "utils/metaMixin";
export default {
  mixins: [metaMixin],
  components: { GanhosAnoChart, GanhosSemanaChart },
  computed: {
    title() {
      return "Home";
    }
  }
};
</script>

<style scoped>
  .card-header {
    font-size: 1rem;
    font-weight: bold;
  }
  .card-body {
    padding: 0.2rem;
  }
</style>
