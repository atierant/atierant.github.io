import './scss/app.scss';

import './js/jquery_global.js';
import $ from 'jquery';

// loads the Bootstrap jQuery plugins
// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
//window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');

// import jquery from "jquery";

import './js/library';
import './js/scale.fix';
import './js/background';

// loads the code syntax highlighting library
import './js/highlight.js';

require('@fortawesome/fontawesome-free/js/all');

// start the Stimulus application
import './bootstrap';

// Application principale
import  './js/main';
