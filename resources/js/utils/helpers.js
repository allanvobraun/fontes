import {interpolateTurbo} from 'd3-scale-chromatic';
import Swal from 'sweetalert2';

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
    const errorArray = Object.entries(errosObj);
    const errorMessageArray = errorArray.map((item) => item[1]);
    return errorMessageArray.join('\n');
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
  },

  scrollToTop() {
    window.scrollTo(0,0);
  },

  /**
   * @param {string} key
   * @param {string[]} arr
   * @returns {string}
   */
  arrayToQueryString(key, arr) {
    const paramArray = arr.map((element, index) => `${key}[${index}]=${element}`);
    return paramArray.join('&');
  },
};
