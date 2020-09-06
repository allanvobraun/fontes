<template>
  <canvas ref="myChart" width="400" height="400"></canvas>
</template>

<script>
  import Chart from 'chart.js';

  export default {
    name: "BaseChart",

    props: {
      chartLabels: {
        type: Array,
        required: true
      },
      chartDatasets: {
        type: Array,
        required: true
      },
      chartOptions: {
        type: Object,
        required: false,
        default: () => {{}}
      },
      chartType: {
        type: String,
        default: () => {return 'bar'}
      }
    },

    data() {
      return {
        chartObj: {}
      }
    },
    computed: {
      chartContext() {
        return this.$refs['myChart'].getContext('2d');
      },

      allDatasetsArray() {
        return this.chartDatasets.reduce((acc, dataset) => {
          return acc.concat(dataset.data)
        }, []);
      },

      chart() {
        return {
          type: this.chartType,
          data: {
            labels: this.chartLabels,
            datasets: this.chartDatasets
          },
          options: this.chartOptions
        }
      }
    },

    mounted() {
      this.startChart();
    },
    methods: {
      startChart() {
        this.chartObj = new Chart(this.chartContext, this.chart);
      }
    },
    watch: {
      allDatasetsArray() {
        this.startChart();
      },
    }
  }
</script>
