const Encore = require('@symfony/webpack-encore');
const path = require('path');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
  // directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // public path used by the web server to access the output path
  // .setPublicPath(process.env.WEBPACK_PUBLIC_PATH || '/build')
  .setPublicPath('/build')
  // only needed for CDN's or subdirectory deploy
  .setManifestKeyPrefix('build/')

  /*
   * ENTRY CONFIG
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  .addEntry('app', './assets/app.js')
  .addEntry('homepage', './assets/js/homepage.js')
  .addEntry('portfolio', './assets/js/portfolio.js')
  .addEntry('search', './assets/js/search.js')
  .addEntry('404', './assets/js/404.js')
  .addStyleEntry('flip-card', './assets/scss/flip-card.scss')
  .addStyleEntry('fonts', './assets/scss/fonts.scss')
  .addStyleEntry('resume', './assets/scss/resume.scss')
  .addStyleEntry('article', './assets/scss/article.scss')
  .addStyleEntry('articles', './assets/scss/articles.scss')
  .addStyleEntry('projects', './assets/scss/projects.scss')
  .addStyleEntry('contact', './assets/scss/contact.scss')
  .addStyleEntry('sticky-note', './assets/scss/sticky-note.scss')

  // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
  .enableStimulusBridge('./assets/controllers.json')

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())
  //.enableVersioning(true)

  .configureBabel((config) => {
    config.plugins.push('@babel/plugin-proposal-class-properties');
  })

  // enables and configure @babel/preset-env polyfills
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = 3;
  })

  // enables Sass/SCSS support
  .enableSassLoader()
  .enablePostCssLoader()

  // uncomment if you use TypeScript
  //.enableTypeScriptLoader()

  // uncomment if you use React
  //.enableReactPreset()

  // uncomment to get integrity="..." attributes on your script & link tags
  // requires WebpackEncoreBundle 1.4 or higher
  .enableIntegrityHashes(Encore.isProduction())

  // .copyFiles({
  //   from: './assets/images',
  //   to: 'images/[path][name].[hash:8].[ext]',
  // })
  .copyFiles({
    from: './assets/images', to: 'images/[path][name].[ext]'
  })
  .copyFiles({
    from: './assets/audio', to: 'audio/[path][name].[ext]'
  })
  .copyFiles({
    from: './assets/videos', to: 'videos/[path][name].[ext]'
  })
  .copyFiles({
    from: './assets/fonts',
    to: 'fonts/[path][name].[hash:8].[ext]',
    pattern: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/
  })
  .copyFiles({
    from: './node_modules/bootstrap-icons/font/fonts',
    to: 'webfonts/[path][name].[hash:8].[ext]',
    pattern: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/
  })

  // uncomment if you're having problems with a jQuery plugin
  .autoProvidejQuery()

  // uncomment if you use API Platform Admin (composer req api-admin)
  //.enableReactPreset()
  //.addEntry('admin', './assets/js/admin.js')

  // Required for styles hot reloading with Webpack dev server
  .disableCssExtraction(Encore.isDevServer())
  .configureDevServerOptions(options => {
    // Watch Twig & yaml files to force reload the browser on changes:
    options.liveReload = true;
    options.watchFiles = ['templates/**/*.twig', 'content/**/*.{yaml,md}',];

    // Disable watching the static `public` folder since it would force a live reload on any change,
    // as the manifest.json file is always re-computed (but not required by the dev server):
    options.static.watch = false;
  })

  .addAliases({
    scssRootDir: path.resolve(__dirname, 'assets/scss')
  });

module.exports = Encore.getWebpackConfig();
