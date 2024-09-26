<?php

namespace ProcessWire;

/**
 * This file will be loaded by RockFrontend whenever livereload detects
 * a change in the source files. By default it will run npm run build to compile
 * the css from tailwind, but you can add other commands to run other scripts
 * like running tests or linters as you need.
 *
 * If you are not using Tailwind or you don't need to compile anything, you
 * can remove this file.
 */

if (!defined('PROCESSWIRE')) die();

// early exit if not in debug mode or livereload is not enabled
if (!wire()->config->debug) return;
if (!wire()->config->livereload) return;

// run npm build to compile css from tailwind
exec('npm run build');
