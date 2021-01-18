const path = require('path');
const webpack = require('webpack');

module.exports = {
  // devtool: '#source-map',
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      'images': path.resolve(__dirname, "./resources/assets/images/"),
      'charts': path.resolve(__dirname, "./resources/js/charts"),
      'components': path.resolve(__dirname, './resources/js/components'),
      'classes': path.resolve(__dirname, './resources/js/classes'),
      'views': path.resolve(__dirname, './resources/js/views'),
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
  },
  externals: {
    moment: 'moment'
  }
}
