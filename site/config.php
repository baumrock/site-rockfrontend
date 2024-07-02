<?php

namespace ProcessWire;

if (!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

/** @var Config $config */
$config->useFunctionsAPI = true;
$config->usePageClasses = true;
$config->useMarkupRegions = false;
$config->prependTemplateFile = '_init.php';
$config->appendTemplateFile = '_rockfrontend.php';
$config->templateCompile = false;
$config->defaultAdminTheme = 'AdminThemeUikit';

/*** INSTALLER CONFIG ********************************************************************/
$config->dbHost = 'db';
$config->dbName = 'db';
$config->dbUser = 'db';
$config->dbPass = 'db';
$config->dbPort = '3306';
$config->dbCharset = 'utf8mb4';
$config->dbEngine = 'InnoDB';

$config->chmodDir = '0755'; // permission for directories created by ProcessWire
$config->chmodFile = '0644'; // permission for files created by ProcessWire
$config->installed = 1719921602;

$config->timezone = 'Europe/Vienna';
$config->httpHosts = array('site-rockfrontend.ddev.site');
$config->debug = false;

require __DIR__ . "/config-local.php";
