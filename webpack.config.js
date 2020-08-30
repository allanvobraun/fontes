const path = require('path');
const webpack = require('webpack');

module.exports = {

  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      'images': path.resolve(__dirname, "./resources/assets/images/"),
      'charts': path.resolve(__dirname, "./resources/js/charts")
    }
  },
  devServer: {
    proxy: {
      '*': '127.0.0.1:8000'
    },
    watchOptions: {
      aggregateTimeout: 200,
      poll: 5000
    },
  }
}
