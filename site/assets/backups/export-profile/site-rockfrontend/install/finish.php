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
/** @var Pages $pages */
/** @var User $user */
// …and so on for other API variables

// copy config files to pw root
wire()->files->copy(
  __DIR__ . '/assets/tailwind.config.js',
  $config->paths->root
);
wire()->files->copy(
  __DIR__ . '/assets/package.json',
  $config->paths->root
);

// copy livereload.php to site folder
wire()->files->copy(
  __DIR__ . '/assets/livereload.php',
  $config->paths->site
);

$installer->ok('Finished installing site profile');
