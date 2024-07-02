<?php

namespace ProcessWire;

// Optional initialization file, called before rendering any template file.
// This is defined by $config->prependTemplateFile in /site/config.php.
// Use this to define shared variables, functions, classes, includes, etc.

$rf = rockfrontend();

$rf->styles()
  // add the base uikit theme
  ->add('/site/templates/uikit/src/less/uikit.theme.less')
  // add default folders like /sections and /partials
  ->addDefaultFolders()
  // add the bundled tailwind utility classes
  ->add('/site/templates/bundle/tailwind.css')
  // minify on production
  ->minify($config->debug ? false : true);

$rf->scripts()
  // load uikit (without defer to avoid FOUC)
  ->add('/site/templates/uikit/dist/js/uikit.min.js')
  // load custom javascript of this project
  ->add('/site/templates/scripts/main.js', 'defer')
  // minify on production
  ->minify($config->debug ? false : true);
