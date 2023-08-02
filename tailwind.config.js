/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'templates/**/*.html.twig',
    'templates/**/**/*.html.twig',
    "./node_modules/flowbite/**/*.js",
    'assets/js/**/*.js',
    "./src/**/*.{html,js}",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ]
}

