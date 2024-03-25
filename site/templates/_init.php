<?php

namespace ProcessWire;

// Optional initialization file, called before rendering any template file.
// This is defined by $config->prependTemplateFile in /site/config.php.
// Use this to define shared variables, functions, classes, includes, etc.

$rf = rockfrontend();

$rf->styles()
  ->add('/site/templates/bundle/tailwind.css')
  ->add('/site/templates/uikit/src/less/uikit.theme.less')
  ->addDefaultFolders()
  ->minify($config->debug ? false : true);

$rf->scripts()
  ->add('/site/templates/uikit/dist/js/uikit.min.js')
  ->add('/site/templates/scripts/main.js', 'defer')
  ->add('/site/modules/RockCommerce/RockCommerceSite.min.js', 'defer')
  ->minify($config->debug ? false : true);
