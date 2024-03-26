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
        'title': ['RecoletaMedium', '"Publico Text"', ...defaultTheme.fontFamily.serif],
        'blockquote': defaultTheme.fontFamily.serif,
        'article-headline': ['"Publico Headline"', ...defaultTheme.fontFamily.serif],
        'article-body': ['"Publico Text"', ...defaultTheme.fontFamily.sans],
      },
      fontSize: {
        '6xl': '4rem'
      },
      lineHeight: {
        'article-title': '1',
        'article-summary': '1.3',
      },
      colors: {
        // Remember to change these in mjml too!
        sdb: {
          blue: '#07397E',
          violet: '#3c00bd',
          sky: '#017fa7',
          red: '#c00000',
          brown: '#730347',
          teal: '#006067',
        },
        'sdb-gray': {
          100: '#FAFAFB',
          200: '#F0F2F5',
          300: '#DDE3EE',
          400: '#B3BFD1',
          500: '#5A6B88',
        },
        accent: '#A731D1',
      }
    },
    container: {
      center: true,
      screens: {
        sm: '670px',
        md: '670px',
        lg: '670px',
        xl: '670px',
        '2xl': '670px'
      }
    }
  },
  plugins: [],
}
