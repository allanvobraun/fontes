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
        default: () => 'bar'
      }
    },

    data() {
      return {
        chartObj: {},
        chartConfigurationObject: {
          type: null,
          data: {
            labels: null,
            datasets: null
          },
          options: null
        }
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
      }
    },

    updated() {
      this.startChart();
    },

    methods: {
      startChart() {
        this.chartConfigurationObject.type = this.chartType;
        this.chartConfigurationObject.data = {labels: this.chartLabels, datasets: this.chartDatasets};
        this.chartConfigurationObject.options = this.chartOptions;

        this.chartObj = new Chart(this.chartContext, this.chartConfigurationObject);
      }
    }
  }
</script>
