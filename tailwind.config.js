const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./site/**/*.php'],
  safelist: [
    {
      pattern: /text-sdb-.+/,
    }
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Inter', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        sdb: {
          blue: '#07397E',
          violet: '#3c00bd',
          sky: 'rgb(1, 127, 167)',
          red: 'rgb(192, 0, 0)',
          brown: 'rgb(115, 3, 71)',
          teal: 'rgb(0, 96, 103)',
        }
      }
    },
    container: {
      center: true,
      screens: {
        sm: '640px',
        md: '640px',
        lg: '640px',
        xl: '640px',
        '2xl': '640px'
      }
    }
  },
  plugins: [],
}
