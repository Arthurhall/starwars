/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('../css/dashboard.scss');
require('../css/flag-icon.scss');

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
const feather = require('feather-icons');
require('./components/search-autocomplete');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    feather.replace();
    $('.autocomplete').searchAutocomplete();
});
