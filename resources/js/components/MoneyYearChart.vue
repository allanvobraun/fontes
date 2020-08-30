<template>
  <div>
    <bar-chart-money :getData="getMonth" :chartLabels="labels"></bar-chart-money>
    teste
  </div>

</template>

<script>
// import LineChartMoney from "charts/LineChartMoney.js";
import BarChartMoney from 'charts/BarChartMoney.vue';

export default {
  components: {
    BarChartMoney,
  },
  methods: {
    getMonth(monthNum, year) {
      const endPoint = "/api/fontes/reparos/valorSum?";
      const filters = `filter[mes]=${monthNum}&filter[ano]=${year}`;

      return axios
        .get(endPoint + filters)
        .then((response) => {
          return response.data.data;
        })
        .catch((err) => {
          const error = err.response.data.erros;
          this.notify("Erro ao buscar dados", error, "danger");
        });
    },
  },
  data() {
    return {
      labels: [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro",
      ],
    };
  },
};
</script>

<style>
</style>
