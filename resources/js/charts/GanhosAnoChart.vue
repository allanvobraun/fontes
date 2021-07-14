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
    chartYears() {
      const finalYear = new Date().getFullYear();
      return _.range(this.firstYear, finalYear + 1);
    }
  },

  methods: {
    setChartData() {
      this.getChartData(this.chartYears).then(result => {
        _.forIn(result, (value, key) => {
          const dataSetObj = {
            data: value,
            label: key,
            backgroundColor: this.$helpers.randomColor(),
          }
          this.datasets.push(dataSetObj);
        })
      });
    },

    async getChartData(years) {
      const query = this.$helpers.arrayToQueryString('anos', years);
      const response = await axios.get('/api/fontes/reparos/valorReparosAnual?' + query);
      return response.data.data;
    },
  }
}
</script>

