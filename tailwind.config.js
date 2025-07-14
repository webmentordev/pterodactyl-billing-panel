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
                '1000px': {
                    max: '1000px'
                },
                '920px': {
                    max: '920px'
                },
                '890px': {
                    max: '890px'
                },
                '870px': {
                    max: '870px'
                },
                '800px': {
                    max: '800px'
                },
                '750px': {
                    max: '750px'
                },
                '660px': {
                    max: '660px'
                },
                '550px': {
                    max: '550px'
                },
                '530px': {
                    max: '530px'
                },
                '510px': {
                    max: '510px'
                },
                '470px': {
                    max: '470px'
                },
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
                "rust": "#FF7623",
                "rust-green": "#5D7239"
            }
        },
    },

    plugins: [forms],
};
