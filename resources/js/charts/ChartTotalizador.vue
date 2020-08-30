<template>
  <div>
    <canvas id="myChart" ref="myChart" width="400" height="400"></canvas>
    <number-badge :number="totalAno" text="Total: R$"></number-badge>
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
      totalAno() {
        return this.chartDataArray.reduce((acc, mes) => {
          return acc + mes
        });
      }
    }
  }
</script>

<style scoped>

</style>
