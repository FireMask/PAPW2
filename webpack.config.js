var webpack = require('webpack');
module.exports = {
    entry: {
        main: __dirname + "/resources/assets/js/main.js"
    },
    output: {
        path: __dirname + "/public/js/dist/",
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
            'jquery': __dirname + '/node_modules/jquery/dist/jquery.js',
            'handlebars': __dirname + '/node_modules/handlebars/dist/handlebars.js',
            'vue': __dirname + '/node_modules/vue/dist/vue.js',
            'datatables': __dirname + '/node_modules/datatables.net-bs/js/dataTables.bootstrap.js'
        }
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" }
        ]
    }
};
