module.exports = {
    entry: {
        main: __dirname + "/main.js"
    },
    output: {
        path: __dirname + "/dist/",
        filename: "[name].bundle.js",
        chunkFilename: "[id].bundle.js"
    },
    resolve: {
        alias: {
            'jquery': __dirname + '/../../vendor/components/jquery/jquery.js',
        }
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" }
        ]
    }
};
