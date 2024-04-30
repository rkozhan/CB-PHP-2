/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php', 
    './pages/*.php', 
    './actions/*.php', 
    './components/*.php'
  ],
  theme: {
    screens: {
      sm: '960px',
      md: '1280px',
      lg: '1680px'
    },
    extend: {
      colors: {
        pink: {
          '50': '#abfdfa',
          '100': '#abfbf1',
          '200': '#abf6e4',
          '300': '#abead4',
          '400': '#abd4bf',
          '500': '#abb8a6',
          '600': '#ab9488',
          '700': '#ab766e',
          '800': '#ab5e59',
          '900': '#ab4e4a',
        }
      },
    },
  },
  plugins: [],
}

