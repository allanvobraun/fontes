import {interpolateTurbo} from 'd3-scale-chromatic';

export default {
  /**
   * @description Pega um objeto de erro e retorna um string com todos os erros
   * @param {object} error
   * @param {object} error.data
   * @param {object} error.data.erros
   *
   * @return {string}
   */
  getErroString(error) {
    const errosObj = error.data.erros;
    const errosObjStrings = _.mapValues(errosObj, erroList => erroList.join('.\n'));
    let stringFinal = '';
    _.forIn(errosObjStrings, (value, key) => {
      stringFinal += `${key}:\n${value}.\n\n`
    });
    return stringFinal;
  },

  /**
   * @description Arrendonda para duas casas decimais somente se necessario
   * @param {number} number
   * @return {number}
   */
  round2(number) {
    return Math.round((number + Number.EPSILON) * 100) / 100;
  },

  /**
   *
   * @param {number} number
   * @returns {string}
   */
  numberToMonth(number) {
    const meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    return meses[number + 1];
  },

  /**
   * Gera uma cor aleatoria  usando um random de 0 a 1
   * @returns {string}
   */
  randomColor() {
    return interpolateTurbo(Math.random());
  }

};
