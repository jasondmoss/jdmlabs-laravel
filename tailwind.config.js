/** @type {import("tailwindcss").Config} */
module.exports = {
    content: [
        "resources/views/**/*.blade.php",
        "resources/assets/js/**/*.js"
    ],
    theme: {
        screens: {
            'md': '890px'
        }
    },
    plugins: []
};

