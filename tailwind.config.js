/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/Views/**/*.php',
    './public/**/*.html'
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FB923C',
        secondary: '#FDBA74',
        accent: '#C2410C',
        background: '#FFF7ED',
      },
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
        serif: ['Lora', 'serif'],
      },
      fontSize: {
        'h1': '36px',
        'h2': '30px',
        'h3': '24px',
        'h4': '20px',
        'h5': '18px',
        'h6': '16px',
        'body': '14px',
        'small': '12px',
        'button': '16px',
        'button-sm': '14px',
      },
    },
  },
  plugins: [],
}
