const mix = require('laravel-mix');

mix
  .options({
    terser: {
      terserOptions: {
        compress: {
          drop_console: true,
        },
      },
    },
  })
  .setPublicPath('public')
  .js('resources/assets/js/app.js', 'public')
  .version()
  .webpackConfig({
    resolve: {
      symlinks: false,
      alias: {
        '@': path.resolve(__dirname, 'resources/assets/js/'),
      },
    },
  });
