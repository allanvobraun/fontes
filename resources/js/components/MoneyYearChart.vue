<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  data() {
    return {
      chartdata: {
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
          "Dezembro"
        ],
        datasets: [
          {
            data: [50, 100, 200],
            label: "2020",
            borderColor: "#de1738",
            fill: false
          }
        ]
      },
      chartOptions: {
        
      }
    };
  },
  mounted() {
    this.renderChart(this.chartdata, this.chartOptions);
  }
};
</script>
