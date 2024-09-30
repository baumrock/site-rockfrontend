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
// …and so on for other API variables

// copy config files to pw root
$wire->files->copy(
  __DIR__ . '/assets/tailwind.config.js',
  $config->paths->root
);
$wire->files->copy(
  __DIR__ . '/assets/package.json',
  $config->paths->root
);

// copy livereload.php to site folder
$wire->files->copy(
  __DIR__ . '/assets/livereload.php',
  $config->paths->site
);

// copy config-local.php to site folder
$local = $wire->files->fileGetContents(__DIR__ . '/assets/config-local.php');
$wire->files->filePutContents(
  $config->paths->site . 'config-local.php',
  str_replace(
    ['{salt}', '{host}'],
    [
      $config->userAuthSalt,
      @$config->httpHosts[0],
    ],
    $local
  )
);
$wire->files->filePutContents(
  $config->paths->site . 'config.php',
  "\n\n" .
    "/**\n" .
    " * Split Config Pattern\n" .
    " * See https://www.baumrock.com/en/processwire/modules/site-rockfrontend/docs/config/\n" .
    " */\n" .
    "require __DIR__ . \"/config-local.php\";\n",
  FILE_APPEND
);

// copy .gitignore to root folder
// don't use .gitignore name because it will be removed
// after installation if the checkbox is checked
$wire->files->copy(
  __DIR__ . '/assets/.gitignore',
  $config->paths->root . '.gitignore.example'
);

$installer->ok('Finished installing site profile');
