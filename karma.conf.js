module.exports = function(config) {
  config.set({
    browsers: ['Chrome'],
    frameworks: ['jasmine', 'commonjs'],
    files: [
        'resources/assets/js/components/**/*.template.html',
        'resources/assets/js/components/**/*.js',
        'resources/assets/js/test/**/*.spec.js'
    ],
    exclude: [
        'resources/assets/js/app.js'
    ],
    preprocessors:  {
        // 'resources/assets/js/**/*.html': ['commonjs'],
        'resources/assets/js/components/**/*.js': ['commonjs'],
        'resources/assets/js/test/**/*.js': ['commonjs']
    }
  });
}