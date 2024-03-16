<?php

namespace ProcessWire;

/**
 * Install finish file (3.0.191+ only)
 *
 * This file is called when profile installation has finished
 * but before install assets have been deleted. The Installer
 * can also be accessed via the $installer variable.
 *
 * Use this file to perform any additional updates to the site
 * that are needed by your site profile.
 *
 * Most ProcessWire API variables are available and locally
 * scoped to this file.
 *
 * ProcessWire versions prior to 3.0.191 ignore this file.
 *
 */

if (!defined("PROCESSWIRE_INSTALL")) die();

/** @var Installer $installer */
/** @var ProcessWire $wire */
/** @var Pages $pages */
/** @var User $user */

// copy files from root assets folder into pw root directory
$root = paths()->root;
$src = $root . 'site/assets/root';
files()->copy($src, $root);
files()->rmdir($src, true);

// add a line to the config.php file that loads config-local.php
$content = '// Load local configuration if it exists\n' . PHP_EOL
  . '$localConfig = __DIR__ . "/config-local.php";' . PHP_EOL
  . 'if (is_file($localConfig)) include $localConfig;';
files()->filePutContents($root . 'site/config.php', $content, FILE_APPEND);
files()->filePutContents($root . 'site/config-local.php', '');

// remove remaining site-blank profile
files()->rmdir($root . "site-blank", true);

$installer->ok('Finished installing site profile');
