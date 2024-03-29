const plugin = require("tailwindcss/plugin");

/** @type {import("tailwindcss").Config} */
module.exports = {
    content: [
        "./resources/assets/js/**/*.js",
        "./resources/views/**/*.blade.php"
    ],
    theme: {
        extend: {}
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),

        plugin(function ({ addComponents }) {
            addComponents({
                // Alerts.
                ".status-error": {
                    borderColor: '#fca5a5',
                    backgroundColor: '#fee2e2',
                    boxShadow: '#fee2e2'
                },
                '.status-create': {
                    borderColor: '#bef264',
                    backgroundColor: '#ecfccb',
                    boxShadow: '#ecfccb'
                },
                '.status-delete': {
                    borderColor: '#fca5a5',
                    backgroundColor: '#fee2e2',
                    boxShadow: '#fee2e2'
                },
                '.status-update': {
                    borderColor: '#bef264',
                    backgroundColor: '#ecfccb',
                    boxShadow: '#ecfccb'
                }
            });
        })
    ]
};
