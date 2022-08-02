const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                grota: ['Grota', ...defaultTheme.fontFamily.sans],
            },
            padding: {
                '3px': '3px',
                '9px': '9px',
            },
            colors: {
                'wgh-red-1': '#FF5233',
                'wgh-red-2': '#FF3815',
                'wgh-red-3': '#D62000',
                'wgh-red-4': '#A31800',

                'wgh-purple-1': '#7000F5',
                'wgh-purple-2': '#6100D4',
                'wgh-purple-3': '#4B00A3',
                'wgh-purple-4': '#340070',

                'wgh-gray-0.5': '#F6F6F7',
                'wgh-gray-1': '#D1D2D6',
                'wgh-gray-1.5': '#B7BAC6',
                'wgh-gray-2': '#9C9FA7',
                'wgh-gray-3': '#767980',
                'wgh-gray-4': '#696C73',
                'wgh-gray-5': '#5D5F65',
                'wgh-gray-6': '#313336',

                'wgh-pink-1': '#F0E4FD',

                'wgh-turquoise-2': '#26E1ED',

                'wgh-yellow-2': '#FBDD11',
                'wgh-yellow-3': '#FFA722',
            },

            borderWidth: {
                3: '3px',
                6: '6px',
                9: '9px',
                10: '10px',
            },
        },
    },
    plugins: [require('@tailwindcss/aspect-ratio')],
};
