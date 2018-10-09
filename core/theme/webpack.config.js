'use strict'

const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin")
const path = require('path');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const WebappWebpackPlugin = require('webapp-webpack-plugin')
const webpack = require('webpack')
const WebpackOnBuildPlugin = require('on-build-webpack')

module.exports = {
  cache: true,
  mode: 'production',
  devtool: 'source-map',
  entry: {
    app: './src/app.js',
    data: './src/data.js',
    vendor: './src/vendor.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].min.js',
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src'),
    },
    extensions: ['.js', '.json'],
  },
  optimization: {
    minimizer: [new UglifyJsPlugin({
      cache: true,
      sourceMap: true,
      parallel: true,
    })]
  },
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [{
          loader: MiniCssExtractPlugin.loader,
        }, {
          loader: 'css-loader', // translates CSS into CommonJS modules
        }, {
          loader: 'postcss-loader', // Run post css actions
          options: {
            plugins: function () { // post css plugins, can be exported to postcss.config.js
              return [
                require('precss'),
                require('autoprefixer')
              ];
            }
          }
        }, {
          loader: 'sass-loader' // compiles Sass to CSS
        }]
      },
      {
        test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: 'assets/img/[name].[hash:7].[ext]',
        }
      },
      {
        test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: 'assets/media/[name].[hash:7].[ext]',
        }
      },
      {
        test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: 'assets/fonts/[name].[hash:7].[ext]',
        }
      },
    ],
  },
  plugins: [
    new UglifyJsPlugin({
      sourceMap: true,
      extractComments: 'all',
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
    }),
    new MiniCssExtractPlugin({
      filename: "[name].min.css",
      chunkFilename: "[id].min.css"
    }),
    new OptimizeCSSAssetsPlugin(),
    // new WebpackOnBuildPlugin(function (stats) {
    //   const newlyCreatedAssets = stats.compilation.assets;
    //   const unlinked = [];
    //   fs.readdir(path.resolve(buildDir), (err, files) => {
    //     files.forEach(file => {
    //       if (!newlyCreatedAssets[file]) {
    //         fs.unlink(path.resolve(buildDir + file));
    //         unlinked.push(file);
    //       }
    //     });
    //     if (unlinked.length > 0) {
    //       console.log('Removed old assets: ', unlinked);
    //     }
    //   })
    // }),
    // Favicon generator
    new WebappWebpackPlugin({
      logo: path.resolve(__dirname, 'src/assets/images/logo.png'),
      prefix: 'assets/favicons/',
    }),
  ],
}
