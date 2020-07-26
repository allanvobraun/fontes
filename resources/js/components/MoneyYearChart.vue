<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  data() {
    return {
      chartdataConfig: {
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
          //chartData
          {
            data: [],
            label: "",
            borderColor: "#de1738",
            fill: false,
          },
        ],
      },
      chartOptions: {
        // tooltips: {
        //   callbacks: {
        //     label(tooltipItem, data) {
        //       return "aab";
        //     },
        //   },
        // },
      },
    };
  },
  mounted() {
    this.chartdata.label = this.chartYear;
    this.setData().then((values) => {
      this.renderChart(this.chartdataConfig, this.chartOptions);
    });
  },
  computed: {
    chartYear() {
      return new Date().getFullYear();
    },
    chartdata() {
      return this.chartdataConfig.datasets[0];
    },
    chartdataValues: {
      get() {
        return this.chartdataConfig.datasets[0].data;
      },
      set(newValue) {
        this.chartdataConfig.datasets[0].data = newValue;
      },
    },
  },
  methods: {
    setData() {
      const year = this.chartYear;
      const results = [];
      for (let i = 1; i < 13; i++) {
        //para cada mes do ano
        let valoreMes = this.getMonthData(i, year);
        results.push(valoreMes);
      }
      // quando todos os dados forem buscados..
      return Promise.all(results).then((resultArray) => {
        this.chartdataValues = resultArray;
      });
    },
    getMonthData(monthNum, year) {
      const endPoint = "/api/fontes/reparos?fields[reparos]=valor";
      const filters = `&filter[mes]=${monthNum}&filter[ano]=${year}`;
      const url = endPoint + filters;

      return axios
        .get(url)
        .then((response) => {
          let respData = response.data.data;
          if (respData.length === 0) return null;

          return respData
            .reduce((sum, reparo) => {
              //soma dos valores no mes
              return sum + reparo.valor;
            }, 0)
            .toFixed(2);
        })
        .catch((err) => {
          try {
            const error = err.response.data.erros;
            this.notify("Erro ao buscar dados", error, "danger");
          } catch (e) {
            this.notify("Erro ao buscar dados", err, "danger");
          }
        });
    },
  },
};
</script>
