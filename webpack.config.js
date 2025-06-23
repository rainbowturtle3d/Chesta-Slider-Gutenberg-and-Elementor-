/**
 * WordPress webpack config.
 */
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
    ...defaultConfig,
    entry: {
        'blocks/chesta-slider-block/index': path.resolve(process.cwd(), 'src/blocks/slider/index.js'),
        'blocks/chesta-slide-block/index': path.resolve(process.cwd(), 'src/blocks/slide/index.js'),
        'admin/chesta-slider-admin': path.resolve(process.cwd(), 'src/admin/admin.js'),
    },
    output: {
        ...defaultConfig.output,
        path: path.resolve(process.cwd(), 'assets/js'),
    },
};

