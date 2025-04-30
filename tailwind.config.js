import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'cos-blue': '#003049',    // Menambahkan warna biru khusus
                'cos-red': '#d62828',   // Menambahkan warna hijau khusus
                'cos-yellow': '#fcbf49',  // Menambahkan warna kuning khusus
                'cos-orange': '#f77f00',
                'cos-cream': '#eae2b7',
            },
        },
    },
    plugins: [],
};
