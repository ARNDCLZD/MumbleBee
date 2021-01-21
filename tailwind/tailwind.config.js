const { CssSyntaxError } = require("postcss")

const colors= require('tailwindcss/colors')
module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      jaune : colors.amber,
      noir : colors.coolGray,
    },
    flex: {
      '1': '1 1 0%',
      auto: '1 1 auto',
     inherit: 'inherit',
      none: 'none',
     '8': '1 1 800%',
    },
    extend: {
      fontFamily : {
        'sans': ['Ovo', 'Helvetica', 'Arial', 'sans-serif']
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
