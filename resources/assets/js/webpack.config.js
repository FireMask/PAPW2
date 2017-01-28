var webpack = require('webpack');
module.exports = {
    entry: {
        main: __dirname + "/main.js"
    },
    output: {
        path: __dirname + "/../../../public/js/dist/",
        filename: "[name].bundle.js",
        chunkFilename: "[id].bundle.js"
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jquery: 'jquery',
            'window.jQuery': 'jquery',
            jQuery: 'jquery'
        })
    ],
    resolve: {
        alias: {
            'jquery': __dirname + '/../../../node_modules/jquery/dist/jquery.js',
            'handlebars': __dirname + '/../../../node_modules/handlebars/dist/handlebars.js',
            'vue': __dirname + '/../../../node_modules/vue/dist/vue.js'
        }
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" }
        ]
    }
};
