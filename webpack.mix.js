// Larvel mix

let mix = require('laravel-mix');
let args = require('yargs');
let purgeFromHTML = require('purgecss-from-html');

let path = require('path');
mix.setPublicPath('./dist');

mix
.js('./assets/js/app.js', './dist/js/app.js')
.js('./assets/js/editor.js', './dist/js/editor.js')
.postCss("./assets/css/app.css", "./dist/css/app.css", [
	require("tailwindcss"),
])
.postCss("./assets/css/editor.css", "./dist/css/editor.css", [
	require("tailwindcss"),
]);

mix.copyDirectory('./assets/images', './dist/images');
mix.copyDirectory('./assets/fonts', './dist/fonts');

