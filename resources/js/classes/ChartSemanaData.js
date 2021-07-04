import helpers from "../utils/helpers";
export default class ChartSemanaData {

  /**
   * @description Builda um objeto para ser usado como um dataset no chart
   * @param {Object[]} semanaArray
   * @param {String} semanaNum
   */
  constructor(semanaArray, semanaNum) {
    this.semanaArray = semanaArray;
    this.semanaId = 'Semana ' + semanaNum;
    this.dataArray = [];
    this.build();
  }

  build() {
    this.semanaArray.forEach((dia) => {
      const index = this.getDiaDaSemanaNum(dia.reparo_data);
      this.dataArray[index] = helpers.round2(dia.valor);
    })
    this.formatarDataArray()
  }

  formatarDataArray() {
    for (let i = 0; i < 7; i++) {
      if (!this.dataArray[i]) {
        this.dataArray[i] = 0;
      }
    }
  }

  getDiaDaSemanaNum(date) {
    const dia = new Date(date);
    return dia.getDay();
  }

  toObject() {
    return {
      data: this.dataArray,
      label: this.semanaId,
      borderColor: helpers.randomColor(),
      fill: false
    }
  }
}
