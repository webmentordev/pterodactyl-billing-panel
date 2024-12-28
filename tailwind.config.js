import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            screens: {
                '360px': {
                    max: '360px'
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "dark": "#1b1b1b",
                "dark-100": "#272727",
                "main": "#E43E3E",
                "rust": "#cd412b",
                "rust-green": "#5D7239"
            }
        },
    },

    plugins: [forms],
};
