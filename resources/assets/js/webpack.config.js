module.exports = {
    entry: {
        main: __dirname + "/main.js"
    },
    output: {
        path: __dirname + "/../../../public/js/dist/",
        filename: "[name].bundle.js",
        chunkFilename: "[id].bundle.js"
    },
    resolve: {
        alias: {
            'jquery': __dirname + '/../../../node_modules/jquery/dist/jquery.js',
            'handlebars': __dirname + '/../../../node_modules/handlebars/dist/handlebars.js'
        }
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" }
        ]
    }
};
