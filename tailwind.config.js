/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/assets/js/**/*.js",
        "./resources/views/**/*.blade.php"
    ],
    theme: {
        extend: {}
    },
    plugins: [
    	require('@tailwindcss/forms'),
    	require('@tailwindcss/typography'),
    ]
}

