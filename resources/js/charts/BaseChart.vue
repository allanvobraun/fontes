<template>
  <canvas id="myChart" ref="myChart" width="400" height="400"></canvas>
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
      }
    },

    data() {
      return {
        chart: {
          type: 'bar',
          data: {
            labels: this.chartLabels,
            datasets: this.chartDatasets
          },
          options: this.chartOptions
        },
        chartObj: {}
      }
    },
    computed: {
      chartContext() {
        return this.$refs['myChart'].getContext('2d');
      },
      chartDataArray() {
        return this.chartDatasets[0].data;
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
      chartDataArray() {
        this.startChart();
      }
    }
  }
</script>
