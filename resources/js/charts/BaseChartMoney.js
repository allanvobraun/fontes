
export var BaseChart = {
  props: {
    getData: {
      // é passado i como parametro de cada iteração
      type: Function,
      required: true
    },
    chartLabels: {
      type: Array,
      required: true
    },
    chartYear: {
      type: Number,
      default() {
        return new Date().getFullYear();
      }
    }
  },
  data() {
    return {
      hovering: false,
      chartdataConfig: {
        labels: this.chartLabels,
        datasets: [
          //chartData
          {
            data: [],
            label: "",
            borderColor: "#de1738",
            fill: false
          }
        ]
      },
      chartOptions: {}
    };
  },
  mounted() {
    this.chartdata.label = this.chartYear;
    this.setData().then(values => {
      this.renderChart(this.chartdataConfig, this.chartOptions);
      this.$emit("rendered", {total: this.dataSum});
      // this.$emit("rendered", 0);
    });
  },
  computed: {
    chartdata() {
      return this.chartdataConfig.datasets[0];
    },
    chartdataValues: {
      get() {
        return this.chartdataConfig.datasets[0].data;
      },
      set(newValue) {
        this.chartdataConfig.datasets[0].data = newValue;
      }
    },
    dataQtd() {
      return this.chartLabels.length;
    },
    dataSum() {
      return this.chartdataValues.reduce((sum, value) => {
        return sum + value
      },0)
    }
  },
  methods: {
    async setData() {
      const results = [];
      for (let i = 1; i < this.dataQtd + 1; i++) {
        //para cada mes ou dia
        let sumValue = this.getData(i, this.chartYear);
        results.push(sumValue);
      }
      // quando todos os dados forem buscados..
      return await Promise.all(results).then(resultArray => {
        this.chartdataValues = resultArray;
      });
    }
  }
};
