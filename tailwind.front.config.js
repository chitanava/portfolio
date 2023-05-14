/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'text-6xl',
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['"Poppins"'],
        'La-belle-aurore': ['"La Belle Aurore"']
      },
    },
  },
  plugins: [],
}