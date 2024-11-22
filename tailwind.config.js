import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ["Ropa Sans", "sans-serif"],
            },
            colors:{
                primary: '#8A52F5',
                secondary: '#FFD009',
                third: '#4BE2FF',
                detailB: '#1CE803',
                detailR: '#F57649',
            },
        },
    },
    plugins: [forms],
};
