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
          <money-year-chart></money-year-chart>
        </b-card>
      </b-col>
      <b-col>
        <b-card
          border-variant="primary"
          header="Reparos Ano"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        ></b-card>
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
export default {
  components: { MoneyYearChart }
};
</script>

<style>
</style>