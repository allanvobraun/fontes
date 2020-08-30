<template>
  <chart-totalizador
    :chart-datasets="datasets"
    :chart-labels="labels"
    :chart-options="options"
  >
  </chart-totalizador>
</template>

<script>
  import ChartTotalizador from "charts/ChartTotalizador";

  export default {
    components: {ChartTotalizador},
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
        datasets: [
          {
            data: [],
            label: "2020",
            backgroundColor: "#de1738",
          }
        ],
        options: {}
      }
    },

    beforeMount() {
      this.setChartData();
    },
    methods: {
      setChartData() {
        this.getChartData().then( result =>{
          this.datasets[0].data = result;
        })
      },
      async getChartData() {
        const results = [];
        for (let i = 1; i < 13; i++) {
          const monthTotal = await this.getTotalMonth(i, 2020);
          results.push(monthTotal);
        }
        return results;
      },

      getTotalMonth(monthNum, year) {
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
      }
    }
  }
</script>

