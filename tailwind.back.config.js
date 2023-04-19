/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'w-4',
    'h-4',
    'w-6',
    'h-6',
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['"Poppins"'],
        'La-belle-aurore': ['"La Belle Aurore"']
      },
    },
  },
  plugins: [require("daisyui")],
}