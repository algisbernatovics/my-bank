const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'Arial', 'sans-serif'],
                serif: ['Lora', 'Georgia', 'serif'],
                mono: ['Inconsolata', 'monospace'],
                nunito: ['nunito', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
