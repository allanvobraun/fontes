import { BaseChart } from './BaseChartMoney';
import { Bar } from "vue-chartjs";

import Vue from "vue";


export default Vue.extend({
  mixins: [BaseChart],
  extends: Bar,
});
