# UIkit Quickstart

Note: Please read the basics about RockFrontend first, then proceed below!

I'm using UIkit because it has 99% of the UI components that I need for any web project. You need a slider? UIkit has it. You need some dropdowns? UIkit has them. You need an accordion? UIkit has it.

Also UIkit comes with a nice JavaScript API and some utilities that are great for quick custom addons: https://github.com/uikit/uikit-site/blob/feature/js-utils/docs/pages/javascript-utilities.md;

## Why UIkit?

Choosing UIkit as the foundation for all my projects was a deliberate decision. While the utility-classes approach of Tailwind CSS is appealing for its simplicity and flexibility, building complex UI components from scratch can be a daunting task. This is especially true when considering accessibility features like keyboard navigation, which are often overlooked or difficult to implement correctly.

UIkit, on the other hand, offers a comprehensive suite of pre-built components that are both functional and aesthetically pleasing. Its development by a team of German design professionals ensures a high standard of quality and attention to detail. Moreover, UIkit's stable release cycle means that we can rely on it without worrying about frequent breaking changes.

By integrating Tailwind CSS with UIkit, we leverage the best of both worlds: the utility-first approach of Tailwind for custom styling and the robust, ready-to-use components of UIkit. This combination allows us to create unique, modern web interfaces with efficiency and precision.

## Customising UIkit

You can customise many aspects of UIkit by simply overriding some LESS variables. For example you could add this in `/site/templates/sections/header.less`:

```less
@navbar-nav-item-color: red;
```

Please see the UIkit docs for details. I'd also recommend installing <a href='https://marketplace.visualstudio.com/items?itemName=mrmlnc.vscode-less' target=_blank>a Plugin for your IDE</a> to get hints about all available variables:

<img src=https://i.imgur.com/CaeamoC.png width=500>
