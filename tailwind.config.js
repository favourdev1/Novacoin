import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '60vw': '60vw',
            },
            backgroundImage: theme => ({
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-linear': 'linear-gradient(var(--tw-gradient-angle), var(--tw-gradient-stops))',
                'gradient-conic': 'conic-gradient(var(--tw-gradient-stops))',
            }),
        },
    },
    variants: {
        extend: {
            backgroundImage: ['hover', 'focus'],
        },
    },

    plugins: [forms, typography],
};