<template>
  <div class="totalizador">
    <b-card border-variant="dark" align="center">
      <canvas ref="myChart" width="100%" height="100%"></canvas>
    </b-card>
    <number-badge :number="totalDados" text="Total: R$"></number-badge>
  </div>

</template>

<script>
  import BaseChart from "charts/BaseChart";
  import NumberBadge from "components/NumberBadge.vue";
  export default {
    name: "ChartTotalizador",
    extends: BaseChart,
    components: {NumberBadge},
    computed: {
      totalDados() {
        if (this.allDatasetsArray.length <= 1) return 0;
        return  this.allDatasetsArray.reduce((acc, mes) => {
          return acc + mes
        }, 0);
      }
    }
  }
</script>

<style scoped>
  .card-body {
    margin-bottom: 0.5rem;
    padding: 0;
  }
  .totalizador {
    padding: 0.2rem;
  }
  .totalizador > * {
    margin: 0.5rem;
  }
</style>
