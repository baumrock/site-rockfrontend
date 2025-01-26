<?php

namespace ProcessWire;

/** @var Config $config */

$config->debug = true;
$config->advanced = true;

// database etc
$config->dbName = 'db';
$config->dbUser = 'db';
$config->dbPass = 'db';
$config->dbHost = 'db';
$config->userAuthSalt = '12345';
$config->tableSalt = '12345';
$config->httpHosts = ['site-rockfrontend.ddev.site'];
$config->sessionFingerprint = false;

// RockDevTools
$config->rockdevtools = true;
$config->livereload = true;

// RockMigrations
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
  'editor' => 'windsurf://file/%file:%line',
];
