# Tailwind CSS Quickstart

Note: Please read the basics about RockFrontend first, then proceed below!

<div class=uk-alert>If you don't want to use TailwindCSS simply don't install it! The Profile will work without it just as well :)</div>

## Why Tailwind CSS?

Tailwind CSS offers a unique advantage when it comes to customizing your design, especially when used in conjunction with UIkit. A common challenge with UIkit is its limited customization options for certain components, such as the grid's gutter sizes. Typically, you're restricted to small, medium, or large options. If your design requires a more specific size, you would need to create a `.less` file, identify the correct selector, and manually set properties like `gap: 12px`. This process is not only tedious but can also lead to difficulties in maintaining your code.

By integrating Tailwind's utility classes, you can effortlessly customize UIkit components directly within your markup. For instance, you can use UIkit's grid component and simply add a `gap-3` class to precisely define the grid gap. This approach allows for direct adjustments of margins, padding, and other styles without the need to navigate away from your markup file.

Another significant advantage of combining Tailwind CSS with UIkit is the reduction of utility class bloat. Tailwind, while powerful, can lead to an excessive number of utility classes when used exclusively. UIkit, on the other hand, provides a comprehensive set of components with well-considered defaults. By using Tailwind to apply only the necessary customizations, you achieve a cleaner, more manageable codebase. This synergy not only streamlines your development process but also enhances the clarity of your markup, making it easier to understand the applied styles at a glance.

## Setup

Tailwind is not enabled by default - you need to install it via RockFrontends module config screen (in the ProcessWire backend search "RockFrontend" and see the section about TailwindCSS).

## Caveats

While integrating Tailwind CSS with UIkit offers numerous advantages, it's important to acknowledge potential conflicts that may arise due to overlapping or resetting styles between the two frameworks. In some cases, UIkit and Tailwind classes might conflict, or one framework might reset styles that are essential for the other.

Despite these challenges, manual resolution of such conflicts is typically straightforward. By carefully inspecting the affected elements and applying specific styles to address the conflicts, developers can effectively manage and mitigate these issues. It's a small trade-off for the flexibility and customization benefits that the combination of Tailwind CSS and UIkit provides.

In practice, keeping a vigilant eye on the styling of components during development can help identify and resolve conflicts early on. Additionally, leveraging the utility-first approach of Tailwind CSS allows for more granular control over styling, making it easier to adjust specific properties without affecting the overall design integrity.

Ultimately, the synergy between Tailwind CSS and UIkit can significantly enhance your project's design capabilities, provided you're prepared to handle occasional styling conflicts with a proactive and thoughtful approach.
