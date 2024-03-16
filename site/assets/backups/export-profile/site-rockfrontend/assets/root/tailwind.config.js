/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./site/templates/**/*.latte",
    "./site/templates/RockForms/**/*.php",
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
};
