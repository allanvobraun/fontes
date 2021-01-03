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
  props: {
    ano: {
      type: String,
      required: true
    }
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
      datasets: [],
      options: {},
      firstYear: 2020
    }
  },

  beforeMount() {
    this.setChartData();
  },

  computed: {
    finalYear() {
      return new Date().getFullYear();
    }
  },

  methods: {
    setChartData() {
      const yearRange = _.range(this.firstYear, this.finalYear + 1);
      yearRange.forEach((year, idx) => {

        this.getChartData(year).then(result => {
          const dataSetObj = {
            data: result,
            label: year,
            backgroundColor: this.$helpers.randomColor(),
          }
          this.datasets.push(dataSetObj);
        })
      });
    },

    getChartData(year) {
      return axios.get(`/api/fontes/reparos/valorReparosAnual?ano=${year}`).then((response) => {
        return this.formatDataMeses(response.data.data)
      });
    },

    formatDataMeses(unformatedData) {
      const data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      for (let i = 0; i < data.length; i++) {
        const dataObj = unformatedData.find((obj) => obj.mes === i + 1);
        if (dataObj) {
          data[i] = dataObj.valor;
        }
      }
      return data;
    }
  }
}
</script>

