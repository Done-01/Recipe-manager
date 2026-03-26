/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'pastel-orange': '#FFDAB9', // A light, desaturated orange
      },
    },
  },
  plugins: [],
}
