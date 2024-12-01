/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/tw-elements/js/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("tw-elements/plugin.cjs"), require("@tailwindcss/forms")],
  darkMode: "class",
};
