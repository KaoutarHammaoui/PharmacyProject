/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class' if you want dark mode support
  theme: {
    extend: {
      // add your customizations here
    },
  },
  plugins: [],
};
