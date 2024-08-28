/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
    colors:{
      /*Theme Colors*/
      'brand': '#F97316', //RGB(249, 115, 22)
      'darkest': '#111827', //RGB(17, 24, 39)
      'dark': '#2C3549', //RGB(44, 53, 73)
      'mid': '#B5BBC7', //RGB(181, 187, 199)
      'light': '#E8EDF2', //RGB(232, 237, 242)
      'lightest': '#FFFFFF', //RGB(255, 255, 255)
      /*Badges [Tailwind defaults]*/
      'red-500': '#ef4444',
      'orange-500': '#f97316',
      'yellow-300': '#fde047',
      'emerald-400': '#34d399',
      'green-700': '#15803d',
      'cyan-400': '#22d3ee',
      'blue-500': '#3b82f6',
      'transparent': 'RGBA(0,0,0,0)'
    },
  },
  darkMode: 'selector',
  plugins: [],
}

