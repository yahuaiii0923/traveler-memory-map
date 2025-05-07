import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import animate from 'tailwindcss-animate';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'fadeInUp': 'fadeInUp 0.6s ease-out',
                'fadeInUp-100': 'fadeInUp 0.6s ease-out 0.1s forwards',
                'fadeInUp-200': 'fadeInUp 0.6s ease-out 0.2s forwards',
            },
            keyframes: {
                fadeInUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(20px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    },
                }
            },
            backgroundImage: {
                'gradient-blue': 'linear-gradient(to bottom right, #f0f9ff 0%, #e0f2fe 100%)',
                'gradient-primary': 'linear-gradient(to bottom right, #1e40af 0%, #1d4ed8 100%)',
                'hero-pattern': "url('data:image/svg+xml,%3Csvg width=\"52\" height=\"26\" viewBox=\"0 0 52 26\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"
            },
            boxShadow: {
                'soft': '0 8px 32px rgba(0, 0, 0, 0.05)',
                'card': '0 4px 24px rgba(0, 0, 0, 0.08)'
            },
            container: {
                padding: {
                    DEFAULT: '1rem',
                    sm: '2rem',
                    lg: '4rem'
                },
                center: true
            }
        },
    },

    plugins: [
        forms,
        animate,
        function({ addComponents }) {
            addComponents({
                '.feature-icon': {
                    '@apply w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center mb-6 mx-auto': {}
                },
                '.timeline-marker': {
                    '@apply absolute w-4 h-4 bg-blue-600 rounded-full -left-[9px] top-0': {}
                }
            })
        }
    ],
};
