<?php

namespace ProcessWire;

/** @var Config $config */

/**
 * Local config for development
 * DO NOT USE THIS FILE IN PRODUCTION!
 * DO NOT ADD THIS FILE TO GIT!
 */

$config->debug = true;
$config->advanced = true;
$config->userAuthSalt = '{salt}';
$config->httpHosts = ['{host}'];

// this is to prevent unwanted logouts when switching
// between desktop and mobile in browsers dev tools
$config->sessionFingerprint = false;

// Activate RockDevTools livereload
$config->rockdevtools = 1;

// RockMigrations
// See https://www.baumrock.com/en/processwire/modules/rockmigrations/docs/filesondemand/
// $config->filesOnDemand = 'https://your-live.site/';

$config->rockmigrations = [
  'syncSnippets' => true,
];

// tracy config for ddev development
$config->tracy = [
  'outputMode' => 'development',
  'guestForceDevelopmentLocal' => true,
  'forceIsLocal' => true,
  'localRootPath' => getenv("TRACY_LOCALROOTPATH"),
  'numLogEntries' => 100, // for RockMigrations
  // 'editor' => 'cursor://file/%file:%line',
];
