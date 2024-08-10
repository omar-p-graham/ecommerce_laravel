/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
    /*colors:{
      'my_white': '#FDFDFD', //rgb(255, 255, 255)
      'my_green': '#527853', //rgb(82, 120, 83)
      'my_beige': '#F9E8D9', //rgb(249, 232, 217)
      'my_peach': '#F7B787', //rgb(247, 183, 135)
      'my_lt_orange': '#EE7214', //rgb(238, 114, 20)
      'my_dk_orange': '#DC5F00', //rgb(220, 95, 0)
      'my_black': '#373A40', //rgb(55, 58, 64)
      'my_lt_grey': '#EEEEEE', //rgb(238, 238, 238)
      'my_dk_grey': '#686D76', //rgb(104, 109, 118)
    },*/
  },
  darkMode: ['variant', [
    '@media (prefers-color-scheme: dark) { &:not(.light *) }',
    '&:is(.dark *)',
  ]],
  plugins: [],
}

