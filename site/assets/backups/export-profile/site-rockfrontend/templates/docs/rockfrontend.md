# RockFrontend Quickstart

If you are totally new to RockFrontend please check out <a href=https://www.baumrock.com/en/processwire/modules/rockfrontend/docs target=_blank>the docs on baumrock.com</a>!

## LiveReload

Add `$config->livereload = 1` to your `config-local.php` file and you will get instant reloads whenever you save a file. Note that only active browser windows will be reloaded! That's to prevent issues that can accur when multiple reloads cause an endless reload loop.

## Frontend Markup

Markup on the frontend is rendered by RockFrontend using the Latte Template Engine. See <a href=https://latte.nette.org/en target=_blank>the docs here</a> and <a href=https://processwire.com/talk/topic/27367-why-i-love-the-latte-template-engine target=_blank>why I love using it</a> - Spoiler: It is very close to PHP, so it feels very familiar right from the beginning and it has some great helpers that make your life easier.

- First, it loads `/site/templates/_init.php` for site assets and SEO setup.
- Then it loads the main entry file for rendering the frontend `/site/templates/layout.latte`.

Please see these files for details!

## Style Assets

As you can see in `_init.php` RockFrontend will load two CSS files from `/site/templates/bundle` for your project:

- `main.css` is the css file compiled from all `.less` files in your project (uikit theme + custom less files).
- `tailwind.css` holds all tailwind reset directives and at the bottom it contains all utility classes that you add to your markup (eg `text-red-500` and such).

## Adding Custom Styles

There are two ways to add custom styles to your frontend:

- By using Tailwind utility classes (see <a href=../tailwind>docs</a>)
- By adding custom CSS/LESS

In `_init.php` there is the line `$rf->styles()->addDefaultFolders()` which makes RockFrontend scan some folders like `/site/templates/sections` and `/site/templates/partials` for `.less` files and automatically load them into the final bundle.

So most of the time adding custom CSS is just adding a single LESS file. You can either place your files in `/site/templates/styles` or - which I prefer - create a less file for every markup file to reflect a component approach.

Example: Let's say you work on the main navigation of your website. You'd probably create the file `/site/templates/sections/navbar.latte` for the markup and the file `/site/templates/sections/navbar.less` for adding custom styles or overriding UIkit variables.

I place global styles that do not belong to any specific markup file into `/site/templates/styles`, for example the file `typography.less` for headlines or the file `buttons.less` for all buttons.
