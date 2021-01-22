const { CssSyntaxError } = require("postcss")

const colors= require('tailwindcss/colors')
module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    flex: {
      '1': '1 1 0%',
      auto: '1 1 auto',
     inherit: 'inherit',
      none: 'none',
     '8': '1 1 800%',
     '7': '1 1 700%',
     '5': '1 1 52%',
    },
    extend: {
      fontFamily : {
        'sans': ['Ovo', 'Helvetica', 'Arial', 'sans-serif']
      },
      colors: {
        jaune : colors.amber,
        noir : colors.warmGray,
      },
    },
  },
  variants: {
    extend: {
      backgroundColor: ['hover'],
    },
  },
  plugins: [],
}
