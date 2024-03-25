<?php

namespace ProcessWire;

use Latte\Runtime\Html;
use Wa72\HtmlPageDom\HtmlPageCrawler;

// expose the site module as global site() function
function site(): Site
{
  return wire()->modules->get('Site');
}

/**
 * @author Bernhard Baumrock, 16.03.2024
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class Site extends WireData implements Module
{

  public static function getModuleInfo()
  {
    return [
      'title' => 'Site',
      'version' => '1.0.0',
      'summary' => 'Project-specific autoload module. It allows for a centralized and organized way of managing project-level customizations and integrations.',
      'autoload' => true,
      'singular' => true,
      'icon' => 'bolt',
    ];
  }

  /**
   * This method is called on init, just like site/init.php
   * @return void
   * @throws WireException
   */
  public function init()
  {
    // expose this module as "site" API variable
    $this->wire('site', $this);

    // when using RockMigrations we watch this file
    // you can remove this section if you are not using RockMigrations
    if (function_exists('rockmigrations')) {
      // migrate site module before other modules so that if we create global
      // fields we make sure we can use them in other modules
      rockmigrations()->watch($this, 99);
    }
  }

  /**
   * This method is called on ready, just like site/ready.php
   * @return void
   */
  public function ready()
  {
  }

  /**
   * Optional migrations method
   * @return void
   */
  public function migrate()
  {
    // place your migrations here
    // if you are not using RockMigrations you can remove the entire method
  }

  /**
   * This method renders the .md files from the docs folder into the
   * site profiles frontend. You can remove this method after installation
   * @param Page $page
   * @return Html
   */
  public function renderDocs(Page $page)
  {
    $name = $page->name;
    if ($name == "home") $name = "readme";
    $readme = $this->wire->config->paths->templates . "docs/$name.md";

    $str = is_file($readme)
      ? $this->wire->files->fileGetContents($readme)
      : "";

    // convert markdown into html markup
    $md = $this->wire->modules->get('TextformatterMarkdownExtra');
    $md->format($str);
    return rockfrontend()->html($str);
  }
}
