/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./site/templates/**/*.{latte,php}",
    "./site/templates/scripts/main.js",
  ],
  theme: {
    extend: {
      screens: {
        xs: "480px",
        sm: "640px",
        md: "960px",
        lg: "1200px",
        xl: "1600px",
      },
    },
  },
  plugins: [],
  // disable preflight to avoid conflicts with uikit
  // see https://tailwindcss.com/docs/preflight#disabling-preflight
  corePlugins: {
    preflight: false,
  },
};
