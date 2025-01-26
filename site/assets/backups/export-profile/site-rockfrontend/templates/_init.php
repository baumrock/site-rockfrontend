<?php

namespace ProcessWire;

// Optional initialization file, called before rendering any template file.
// This is defined by $config->prependTemplateFile in /site/config.php.
// Use this to define shared variables, functions, classes, includes, etc.

// during development, use RockDevTools to parse, merge and minify assets
// on production, we will just include the minified files in _main.latte
if ($config->rockdevtools) {
  $devtools = rockdevtools();

  // force recreating of minified files on every request
  // $devtools->debug = true;

  // parse all less files to css
  $devtools->assets()
    ->less()
    ->add('/site/templates/uikit/src/less/uikit.theme.less')
    ->add('/site/templates/src/*.less')
    ->save('/site/templates/src/.styles.css');

  // merge and minify css files
  $devtools->assets()
    ->css()
    ->add('/site/templates/src/.styles.css')
    ->add('/site/templates/src/.tailwind.css')
    ->save('/site/templates/dst/styles.min.css');

  // merge and minify JS files
  $devtools->assets()
    ->js()
    ->add('/site/templates/uikit/dist/js/uikit.min.js')
    ->add('/site/templates/scripts/main.js')
    ->save('/site/templates/dst/scripts.min.js');
}
