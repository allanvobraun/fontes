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
      datasets: [
        {
          data: [],
          label: this.ano,
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
      this.getChartData().then(result => {
        this.datasets[0].data = result;
      })
    },

    getChartData() {
      return axios.get(`/api/fontes/reparos/valorReparosAnual?ano=${this.ano}`).then((response) => {
        return this.formatDataMeses(response.data.data)
      });
    },

    formatDataMeses(unformatedData) {
      console.log(unformatedData)
      const data = [];
      for (let i = 0; i < 13; i++) {
        const dataObj = unformatedData.find((obj) => obj.mes === i + 1);
        if (dataObj) {
          data[i] = dataObj.valor;
          continue;
        }
        data[i] =  0;
      }
      return data;
    }
  }
}
</script>

