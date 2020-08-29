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
  }

};
