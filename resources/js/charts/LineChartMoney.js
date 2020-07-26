import { BaseChart } from './BaseChartMoney';
import { Line } from "vue-chartjs";

import Vue from "vue";


export default Vue.extend({
  mixins: [BaseChart],
  extends: Line,
});
