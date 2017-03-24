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
            'datatables': __dirname + '/node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
            'bootstrap-checkbox': __dirname + '/node_modules/bootstrap-checkbox/js/bootstrap-checkbox.js',
            'chartjs': __dirname + '/node_modules/chart.js/dist/Chart.js',
            'bootstrap-fileinput': __dirname + '/node_modules/bootstrap-fileinput/js/fileinput.js',
            'vue-router': __dirname + '/node_modules/vue-router/dist/vue-router.js',
            'vue-resource': __dirname + '/node_modules/vue-resource/dist/vue-resource.js'
        }
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" }
        ]
    }
};
