const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./site/**/*.php'],
  safelist: [
    {
      pattern: /text-sdb-.+/,
    }
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['"Inter Variable"', ...defaultTheme.fontFamily.sans],
        'serif': ['RecoletaMedium', '"Publico Text"', ...defaultTheme.fontFamily.serif],
        'blockquote': defaultTheme.fontFamily.serif,
        'article-headline': ['"Publico Headline"', ...defaultTheme.fontFamily.serif],
        'article-body': ['"Publico Text"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        sdb: {
          blue: '#07397E',
          violet: '#3c00bd',
          sky: 'rgb(1, 127, 167)',
          red: 'rgb(192, 0, 0)',
          brown: 'rgb(115, 3, 71)',
          teal: 'rgb(0, 96, 103)',
        },
        'sdb-gray': {
          100: '#FAFAFB',
          200: '#F0F2F5',
          300: '#DDE3EE',
          400: '#B3BFD1',
          500: '#5A6B88',
        },
        accent: '#A731D1',
        background: '#f5f5f5'
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
