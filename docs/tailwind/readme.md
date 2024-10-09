# TailwindCSS

This profile comes with all you need to use TailwindCSS in your project and is especially optimized for use in combination with UIkit.

## Concept

The concept is quite simple: We use UIkit for all their components (CSS + JS) and then add Tailwind utility classes to make customizing things super easy and fast. The process is as follows:

- first, load `main.css` (compiled UIkit theme + your customisations)
- then, load `tailwind.css` (compiled tailwind utility classes)

That's it!

## Example Usage

The reason why I like the combination of UIkit and Tailwind so much is because I get all the components of UIkit but with the flexibility and power of TailwindCSS.

UIkit is very limited when it comes to margins, padding or flex gaps, etc. This is by design, because if UIkit added all possible combinations of margins, padding or flex gaps to their CSS file, it would rapidly increase the file size.

TailwindCSS on the other hand only adds classes that you actually use in your project, which makes the resulting CSS file very small.

When combining both frameworks, we get the best of both worlds!

Take the simple example of having a flex container with three items inside where we want to adjust the gap between the items.

In plain UIkit we would need to add some CSS, which means we would have to create an additional CSS file or add the directive somewhere to our `main.css` and probably never find it again 😅

UIkit alone:

```html
<div class='uk-flex my-custom-gap'>
  <div>foo</div>
  <div>bar</div>
  <div>baz</div>
</div>
```

Plus the CSS/LESS file:

```css
.my-custom-gap {
  gap: 8px;
}
```

With TailwindCSS:

```html
<div class='uk-flex gap-2'>
  <div>foo</div>
  <div>bar</div>
  <div>baz</div>
</div>
```

That's so much better 🚀😎

## Installation

In the root directory of your project run this command:

```bash
npm install -D
```

This will install all dependencies listed in `package.json` which is - at the time of writing - as simple as this:

```json
{
  "devDependencies": {
    "tailwindcss": "^3"
  },
  "scripts": {
    "build": "npx tailwindcss -i site/templates/_tailwind.css -o site/templates/bundle/tailwind.css"
  }
}
```

<div cass='uk-alert'>New to NPM? You only have to install NPM once for your computer (not for every project). Please see this video for a quickstart: https://youtu.be/P3aKRdUyr0s</div>

As you can see in `package.json` we will only install TailwindCSS and add the script `npm run build` to compile the css.

## Testing the installation

In the root directory of your project run this command:

```bash
npm run build
```

You should get an output like this:

```bash
> build
> npx tailwindcss -i site/templates/_tailwind.css -o site/templates/bundle/tailwind.css

Rebuilding...
Done in 92ms.
```

## How it works

This site profile comes with the file `site/templates/_tailwind.css` which is the main entry point for TailwindCSS and contains these two statements (and some helpful comments):

```css
@tailwind base;
@tailwind utilities;
```

Additionally, the site profile comes with a `tailwind.config.js` file which is used to configure TailwindCSS for your project. You can customize this config file to your needs.

## Preflight Mode

One important aspect when using TailwindCSS in combination with UIkit is this part:

```
corePlugins: {
  preflight: false,
},
```

This tells TailwindCSS not to use preflight mode, which is necessary to avoid conflicts with UIkit. Please see https://tailwindcss.com/docs/preflight#disabling-preflight for more information.
