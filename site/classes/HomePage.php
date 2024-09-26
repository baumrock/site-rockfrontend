<?php

namespace ProcessWire;

/**
 * Example custom page class for pages using template “home”
 *
 * Feel free to delete this file if you do not want it. This is here as a
 * placeholder to ensure the /site/classes/ directory exists.
 *
 * When this file/class is present, page using template “home” will use this
 * class “HomePage” rather than class “Page”. You can do the same for any
 * other templates. For example, template “basic-page” would have a class
 * named “BasicPagePage” and template “admin” would have “AdminPage”, etc.
 *
 * Custom page classes must extend class “Page”, or one derived from it
 * (eg DefaultPage extends Page).
 * See https://processwire.com/blog/posts/pw-3.0.152/#new-ability-to-specify-custom-page-classes
 *
 * @property string $title
 *
 */
class HomePage extends DefaultPage
{
  public $foo = "I am the foo property, set in HomePage.php";

  public function foo()
  {
    return "I am the foo method, set in HomePage.php";
  }
}
