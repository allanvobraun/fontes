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
          <ganhos-ano-chart></ganhos-ano-chart>

        </b-card>
      </b-col>
      <b-col>
        <b-card
          border-variant="primary"
          header="Reparos Ano"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        >
        </b-card>
      </b-col>
      <b-col>
        <b-card
          border-variant="primary"
          header="Ganhos Mês"
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
import MoneyYearChart from "./MoneyYearChart.vue";
// import BaseChart from "charts/BaseChart";
// import ChartTotalizador from "charts/ChartTotalizador";
import GanhosAnoChart from "charts/GanhosAnoChart";
export default {
  components: {GanhosAnoChart}
};
</script>

<style>
</style>
