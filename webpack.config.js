var path = require('path');

module.exports = {
    entry: {
        app: './Front-end/lib/App.js'
    },
    output: {
        path: path.resolve(__dirname, ''),
        filename: 'index.js'
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.js$/,
                include: path.resolve(__dirname, 'Front-end/lib'),
                loader: 'babel-loader',
                query: {
                    presets: ['@babel/preset-env']
                }
            }
        ]
    }
};