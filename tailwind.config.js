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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                customColor: '#049ce3',
                customBlack: '#0A0A0BFF',
                customGrayDark: '#121212FF',
                customGray: '#1E1E20FF',
                customGrayLight: '#3C4045FF',
            }
        },
    },

    plugins: [forms],
};
