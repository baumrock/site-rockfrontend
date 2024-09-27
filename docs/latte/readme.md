# Latte Templating Engine

Latte is a great template engine by Nette - the folks behind TracyDebugger! See <a href='https://latte.nette.org/en/guide'>Getting Started with Latte</a> and also <a href='https://processwire.com/talk/topic/27367-why-i-love-the-latte-template-engine/'>Why I love the Latte Template Engine</a>.

## How it works

In `config.php` this profile sets the `appendTemplateFile` to `_rockfrontend.php`. This file will be loaded after each template file (like `home.php` or `basic-page.php`). It then loads the Latte engine and sends all the variables to the Latte file.

By default the file `_main.latte` will be loaded, but you can also create layouts that are template specific by creating files like `home.latte` or `basic-page.latte` in the `templates` directory.

## Using this profile without Latte (or other template engines)

RockFrontend doesn't force you to use a template engine. If you don't want to use Latte go to `config.php` and change this line:

```php
$config->appendTemplateFile = '_rockfrontend.php';
```

to this:

```php
$config->appendTemplateFile = '_main.php';
```

and then create a new file in the `templates` directory named `_main.php`. This is the setting for using the <a href='https://processwire.com/docs/front-end/output/delayed/'>delayed output strategy</a>.


