<?php

namespace ProcessWire;

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

  public function init()
  {
    // expose this module as "site" API variable
    $this->wire('site', $this);

    if (function_exists('rockmigrations')) {
      // migrate site module before other modules so that if we create global
      // fields we make sure we can use them in other modules
      rockmigrations()->watch($this, 99);
    }
  }

  /**
   * Optional migrations method
   * @return void
   */
  public function migrate()
  {
    // place your migrations here
  }
}
