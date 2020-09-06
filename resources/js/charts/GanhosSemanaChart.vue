<template>
  <chart-totalizador
    :chart-datasets="datasets"
    :chart-labels="labels"
    :chart-options="options"
    chart-type="line"
  >
  </chart-totalizador>
</template>

<script>
  import ChartTotalizador from "charts/ChartTotalizador";
  import ChartSemanaData from "classes/ChartSemanaData";

  export default {
    components: {ChartTotalizador},
    data() {
      return {
        labels: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
        datasets: [{
          data: [0],
          label: '',
          borderColor: '',
          fill: false
        }],
        options: {
          scales: {
            yAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
              }
            }]
          },
        }
      }
    },

    beforeMount() {
      this.setSemanaData();
    },

    methods: {
      async setSemanaData() {
        const semanas = await axios.get('/api/fontes/reparos/valorSemanas')
          .then(response => response.data.data);
        const arrayTeste = [];

        _.forIn(semanas, (arr, label) => {
          const semanaData = new ChartSemanaData(arr, label);
          arrayTeste.push(semanaData.toObject());
        });

        this.datasets = arrayTeste;
      },

    }
  }

</script>

