# UIkit

This profile loads the UIkit CSS framework. I like UIkit for several reasons:

- It's easy to use
- It has good documentation (https://getuikit.com/docs/)
- It has all components that I usually need (Slider, Accordion, Tooltips, etc.)
- It's easy to customize via LESS or SCSS and via Tailwind classes (it's a great combo 😍)
- All components are high quality (think about keyboard navigation, for example)
- It is actively maintained by a german company which sells Joomla and Wordpress themes built with UIkit (https://yootheme.com/)
- It has long release cycles which means websites built with UIkit are likely to remain compatible for a long time, unlike many other frameworks.

## How it works

This profile loads UIkit via RockFrontend in `/site/templates/_init.php`:

```php
$rf = rockfrontend();
$rf->styles()
  ->add('/site/templates/uikit/src/less/uikit.theme.less')
  ...
$rf->scripts()
  ->add('/site/templates/uikit/dist/js/uikit.min.js')
  ...
```

As you can see, this will load UIkit's default theme file, which includes all components. This is good for getting started easily and quickly, but is not ideal for performance.

But we are talking about UIkit having ~85kB gzipped, so it has never been an issue for any of my projects. If it is for you, see https://getuikit.com/docs/less how you can optimise it even further.

## Customization

The main entry point for UIkit is the file `/site/templates/styles/_custom.less`. There you can override all the variables that come with UIkit or add hooks to add custom CSS to any UIkit component.

## Adding other LESS files

In `/site/templates/_init.php` we have the `->addDefaultFolders()` directive, which means you can split your LESS into several files.

For example, you can create the file `/site/templates/styles/test.less` with the following content:

```less
div {
  border: 1px solid red;
}
```

Save the file and LiveReload will reload the page and RockFrontend will automatically compile the new main.css file.
